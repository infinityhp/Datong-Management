<?php
return array(
	//'配置项'=>'配置值'
    'DB_TYPE'=> 'mysql',// 指定数据库是mysql
    'DB_HOST'=> 'localhost',
    'DB_NAME'=>'datong', // 数据库名
    'DB_USER'=>'root',
    'DB_PWD'=>'123456', //您的数据库连接密码
    'DB_PORT'=>'3306',
    'DB_PREFIX'=>'dt_',//数据表前缀
//    'USER_AUTH_KEY'=>'username'

    'AUTH_CONFIG' => array(
        'AUTH_ON' => true, //认证开关
        'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'think_auth_group', //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'think_auth_group_access', //用户组明细表
        'AUTH_RULE' => 'think_auth_rule', //权限规则表
        'AUTH_USER' => 'dt_user'//用户信息表
    ),

    'MENU' => array(
        //rule 对应think_auth_rule表单里的name
        array('item'=>'搜索产品', 'rule'=>'search_product', 'url'=>'/home/product/index'),
        array('item'=>'创建产品', 'rule'=>'create_product', 'url'=>'/home/product/create'),
        array('item'=>'回收站', 'rule'=>'recycle_product', 'url'=>'/home/product/recycle')
    ),


    'SITE_NAME' => '管理系统',
    'IMG_NUM' => 3
);