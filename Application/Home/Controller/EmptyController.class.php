<?php
/**
 * Created by PhpStorm.
 * User: wilkins
 * Date: 2015/1/6
 * Time: 15:18
 */

namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller{
    public function index(){
        //访问错误的控制器
        $this->error('访问路径错误');
    }

}