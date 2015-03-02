<?php
/**
 * Created by PhpStorm.
 * User: wilkins
 * Date: 2014/12/28
 * Time: 22:40
 */
namespace Home\Controller;
use Think\Controller;
class ProductController extends BaseController {
    public function index(){
        // 产品搜索首页
        $this->display();
    }

    public function create(){
        // 创建产品页面
        $Auth = new \Think\Auth();
        $unitDB = M('unit');

        if($Auth->check('create_product',session('uid'))) {
            $unit_list = $unitDB->where('')->select();
            $this->assign('unit', $unit_list);

            $this->assign('img_num', C('IMG_NUM'));
            $this->display();
        }
        else{
            redirect('/home/product');
        }
    }

    public function add(){
        // 创建产品操作
        $Auth = new \Think\Auth();
        $productsDB = D('products');

        $imagesDB = M('products_images');

        $uploadResponse = $this->upload_img();

        if($Auth->check('create_product',session('uid'))) {
//            $new_product = I('post.');
            // post内容自动提交
            if (!$productsDB->create())
                $this->error($productsDB->getError());
            else{
                if($pid = $productsDB->add()){
//                    echo $pid;
                    if($uploadResponse['img']){
                        foreach($uploadResponse['img'] as $image){
                            $imagesDB->add(array('pid'=>$pid, 'image'=>$image));
                        }
                    }
                    $this->success('产品创建成功! ' . $uploadResponse['msg'], '/home/product/item/id/' . $pid);
                }
                else
                    $this->error('产品创建失败' .  $uploadResponse['msg']);
            }
        }
        else{
            redirect('/home/product');
        }
    }

    public function update(){
        //更新产品操作
        $Auth = new \Think\Auth();
        $productsDB = D('products');

        if($Auth->check('update_product',session('uid'))){

            $pid = I('post.id');
            //上传图片
            $imagesDB = M('products_images');

            $uploadResponse = $this->upload_img();

            if(!$productsDB->create())
                $this->error($productsDB->getError());
            else{
                if($productsDB->save() || !empty($uploadResponse['img'])) {
                    if($uploadResponse['img']){
                        foreach($uploadResponse['img'] as $image){
                            $imagesDB->add(array('pid'=>$pid, 'image'=>$image));
                        }
                    }
//                    var_dump($_FILES);
                    $this->success('产品更新成功! ' . $uploadResponse['msg']);
                }
                else
                    $this->error('产品更新失败! ' . $uploadResponse['msg']);
            }
        }
        else{
            redirect('/home/product');
        }
    }

    public function search(){
        // 搜索产皮ajax操作
        $Auth = new \Think\Auth();
        $products   =   M('Products');

        $search_keyword = I('post.keyword');
        //search sku / name / car_type
        $products_list = $products
                ->join("dt_products_images as dpi ON dt_products.id = dpi.pid ", 'LEFT')
                ->where("dt_products.sku LIKE '%%%s%%' or
                        dt_products.name LIKE '%%%s%%' or
                        dt_products.car_type LIKE '%%%s%%'",array($search_keyword, $search_keyword, $search_keyword))
                ->field("dt_products.*, dpi.id as iid")
                ->group('dt_products.id')
                ->order('sku')->select();

        $re_json = array();
        $re_json['show_cost_price'] =  $Auth->check('show_cost_price',session('uid'), 2);
        $re_json['operate_product'] =  $Auth->check('operate_product',session('uid'), 2);

        if(count($products_list)<1000){
            $re_json['error'] = 0;
            $re_json['products_list'] = $products_list;
            echo json_encode($re_json);
        }
        else {
            echo json_encode(array('error'=>1, 'error_message'=>'结果集太大，请增加搜索关键字。'));
        }
    }

    public function search_result(){
    // 搜索产皮ajax操作
        $Auth = new \Think\Auth();
        $products   =   M('Products');

        $search_keyword = I('post.keyword');
            //search sku / name / car_type
        $products_list = $products
        ->join("dt_products_images as dpi ON dt_products.id = dpi.pid ", 'LEFT')
        ->where("dt_products.sku LIKE '%%%s%%' or
                                dt_products.name LIKE '%%%s%%' or
                                dt_products.car_type LIKE '%%%s%%'",array($search_keyword, $search_keyword, $search_keyword))
        ->field("dt_products.*, dpi.id as iid")
        ->group('dt_products.id')
        ->order('sku')->select();

        $data = array();
        $data['show_cost_price'] =  $Auth->check('show_cost_price',session('uid'), 2);
        $data['operate_product'] =  $Auth->check('operate_product',session('uid'), 2);

        if(count($products_list)<1000 && count($products_list) > 0){
        $data['error'] = 0;
        $data['products_list'] = $products_list;
        }
        elseif(count($products_list)>=1000)  {
            $data['error'] = 1;
            $data['error_message'] = '结果集太大，请增加搜索关键字。';
        }
                else{
            $data['error'] = 1;
            $data['error_message'] = '无搜索结果，请重新输入关键字。';
        }
        $this->data = $data;

        $this->display();
    }

    public function item(){
        // 编辑产品页面
        $Auth = new \Think\Auth();
        $products   =   M('Products');
        $imagesDB = M('products_images');
        $unitDB = M('unit');


        if($Auth->check('update_product',session('uid'))){
            $id = I('get.id');
            $product = $products->find($id);
            $this->assign('product', $product);

            $images = $imagesDB->where('pid = %s', $id)->select();
            $this->assign('images', $images);

            $unit_list = $unitDB->where('')->select();
            $this->assign('unit', $unit_list);

            $this->assign('img_num', C('IMG_NUM'));
            $this->display();
        }
        else{
            redirect('/home/product');
        }
    }

    public function delete_image(){
        //删除图片操作
        $img_id = I('get.iid');
        $imagesDB = M('products_images');
//        echo $img_id;
        if($imagesDB->where('id = %d', $img_id)->delete())
        {
            $this->success('图片删除成功');
        }
        else{
            $this->error('图片删除失败');
        }
    }



    public function delete(){
        //删除产品操作
        $Auth = new \Think\Auth();
        $productsDB = M('products');
        $recycleProductsDB = M('recycle_products');
        $imagesDB = M('products_images');

        if($Auth->check('delete_product',session('uid'))){
            $id = I('get.id');
            $product = $productsDB->find($id);
            $recycleProductsDB->add($product);

            if($productsDB->delete($id)){
                $this->success('产品删除成功!');
                $imagesDB->where('pid = %s', $id)->delete();
            }
            else{
                $this->error('产品删除失败');
            }
        }
        else{
            redirect('/home/product');
        }
    }


    public function recycle(){
        //查看回收站页面
        $Auth = new \Think\Auth();
        if($Auth->check('recycle_product',session('uid'))){
            $recycleProductsDB = M('recycle_products');
            $re_products_list = $recycleProductsDB->select();
//            var_dump($re_products_list);
            $this->assign('re_prod', $re_products_list);
            $this->display();
        }
        else{
            redirect('/home/product');
        }
    }

    public function view_image(){
        //查看产品图片页面，不带网页框架，供ajax调用。
        $imagesDB = M('products_images');
        $pid = I('get.pid');
        $this->assign('images', $imagesDB->where('pid = %s', $pid)->select());
        $this->display();
    }

    private function upload_img(){
        //上传图片方法，供更新产品操作调用
        $uploaded_images = array();
        $upload_msg = '';
        if(!empty($_FILES)) {
//            var_dump($_FILES);
            $upload = new \Think\Upload();
            $upload->maxSize = 5000000;// 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Public/'; // 设置附件上传根目录
            $upload->savePath = 'Uploads/'; // 设置附件上传（子）目录
            $upload->thumb = true;
            $upload->thumbMaxWidth = '400,100';        //设置缩略图最大高度
            $upload->thumbMaxHeight = '400,100';        //设置上传文件规则

            $info = $upload->upload();

            if (!$info) {
                // 上传图片错误 提示错误信息
                $upload_msg = $upload->getError();
            } else {
                // 上传图片成功 获取上传文件信息
                $upload_msg = '图片上传成功';

                $image = new \Think\Image();
                foreach ($info as $file) {
                    // 生成缩略图
                    $img_name = './Public/' . $file['savepath'] . $file['savename'];
                    $thumb_name = './Public/' . $file['savepath'] . 'thumb_' . $file['savename'];

                    /* 处理图片方向问题 */
                    $exif = exif_read_data($img_name);
                    $source = imagecreatefromjpeg($img_name);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 8:
                                $source = imagerotate($source, 90, 0);
                                break;
                            case 3:
                                $source = imagerotate($source, 180, 0);
                                break;
                            case 6:
                                $source = imagerotate($source, -90, 0);
                                break;
                        }
                    }
                    imagejpeg($source, $img_name);
                    /* 处理图片方向问题 */

                    $image->open($img_name);
                    $image->thumb(800, 800)->save($img_name);
//                    $image->save('./Public/' . $file['savepath'].'thumb_'.$file['savename']);
                    $uploaded_images[] = $file['savepath'] .  $file['savename'];
                }
            }
            return array('msg'=>$upload_msg, 'img'=>$uploaded_images);
        }
    }

    public function get_autocomplete(){
        //获取输入提示ajax操作
        $field = I('get.field');
        $productsDB = M('products');
        $this->ajaxReturn($productsDB->distinct(true)->field($field)->select());
    }
}