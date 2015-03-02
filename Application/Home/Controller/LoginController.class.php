<?php
/**
 * Created by PhpStorm.
 * User: wilkins
 * Date: 2014/12/28
 * Time: 22:08
 */

namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function login() {
        //登陆操作
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username)) {
            $this->error("帐号不可以为空！");
        }else if (empty($password)) {
            $this->error("密码不可以为空！");
        }

        $map                =   array();
        $map["username"]    =   $username;
        $map["password"]    =   $password;

        $userDB = D('User');
        $account = $userDB->where($map)->select();
        if (empty($account)) {
            $this->error('帐号或密码错误！');
        }
        session('username',$account[0]['username']);
        session('uid',$account[0]['id']);

        $this->success("登录成功!");
        redirect('/Home/Product');
    }

    public function logout() {
        //登出操作
        $sess_username = session('uid');
        if(isset($sess_username)){
            session('uid',null);
            session('username',null);
            $this->success("成功退出！");
        }else {
            $this->error("已经注销登录！");
        }
    }

    public function index(){
        //首页
        redirect('/Home/Index');
    }

}