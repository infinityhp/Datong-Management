<?php
/**
 * Created by PhpStorm.
 * User: wilkins
 * Date: 2014/12/28
 * Time: 22:37
 */

namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function _initialize(){
        //用户登陆信息检测处理
        if (!session("username")) {
            //未登录处理
            redirect('/Home/Index');
        }
        $this->menu = $this->getMenu();

    }

    public function getMenu(){
        //根据用户权限获取菜单栏
        $menu = C('MENU');
        $Auth = new \Think\Auth();

        $re_menu = array();
        foreach($menu as $m_item){
            if($Auth->check($m_item['rule'], session('uid')))
                array_push($re_menu, array('item'=>$m_item['item'], 'url'=>$m_item['url']));
        }

        return $re_menu;
    }
}