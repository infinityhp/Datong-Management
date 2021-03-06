<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <link href="../../Public/css/jquery-ui.css" rel="stylesheet">
    <style>
        body{font-size:16px; margin:0;}
        .central{margin:0 auto; width:600px; height:300px; margin-top:100px; border:5px solid #f6a828; border-radius:6px;}
        .image{float:left;width:250px; text-align:center; padding:48px 0;}
        .image h1{margin:0px; font-size:90px;word-wrap:break-word; letter-spacing:10px;}
        .loginpanel{float:left; width:350px; text-align:right;}
        .loginpanel ul{display:inline; list-style:none;}
        .loginpanel ul{float:left; }
        .loginpanel li{padding:5px;}
        .loginpanel label{float:left; width:125px; margin:1px; font-weight:bold; text-align:right;padding:3px;}
        .loginpanel input{height:20px;padding:2px;}
        .loginpanel .submit_input {height: 30px;width: 100px;background-color: #f6a828;border: 2px solid #e59717;
            color: white;font-size: 20px;}
        @media screen and (max-width:800px){
            .central{width:auto;padding:10px;margin:auto;border:none;border:5px solid #f6a828;}
            .image{width:100%;}
            .image h1{font-size:40px;}
            .loginpanel{text-align:center; width:100%; padding-top:10px; border-top:1px solid #999;}
            .loginpanel ul{float:none; padding-left:0px;}
            .loginpanel label{width:35%;}
            .loginpanel input{width:60%;}
        }
    </style>
    <title> <?php echo (C("site_name")); ?></title>
</head>
<body class="">

    <div id="central" class="central">
        <div class="image">
            <h1><?php echo (C("site_name")); ?></h1>
        </div>
        <div class="loginpanel">
            <form action="/home/login/login" method="post">
                <ul>
                    <li><label>登录名:</label><input type="text" name="username"/></li>
                    <li><label>密码:</label><input name="password" type="password"/></li>
                    <li><label> </label><input class="submit_input" type="submit" value="登陆"/></li>
                </ul>
            </form>
            </div>

<script>

</script>

</body>
</html>