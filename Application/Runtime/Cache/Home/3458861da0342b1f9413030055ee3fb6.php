<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <script src="/Public/js/jquery.1.10.2.js"></script>
    <script src="/Public/js/jquery-ui.js"></script>
    <script src="/Public/js/jquery.hotkey.js"></script>
    <script src="/Public/js/jquery.magnific-popup.min.js"></script>

    <link href="/Public/css/jquery-ui.css" rel="stylesheet">
    <link href="/Public/css/datong.css" rel="stylesheet">

    <title><?php echo (C("site_name")); ?></title>
</head>
<body class="">
<header class="layout">
    <div class="header">
    <h1 style=""><a href="/Home/Product/Index"><?php echo (C("site_name")); ?></a></h1>
    </div>
    <div id="user" class="user">
        <li class="ui-state-default ui-corner-all" style="padding:3px 0;">
            <span class="ui-icon ui-icon-power"></span></li>
        欢迎：  <?php echo (session('username')); ?> <a href="/Home/Login/logout" >登出</a>  系统时间: <?php echo (date('Y-m-d g:i a',time())); ?>
    </div>
    <div id="user_mobile" class="user_mobile">
        <span><?php echo (session('username')); ?> <a href="/Home/Login/logout" >登出</a></span>
    </div>
</header>

<aside class="layout">
    <li class="ui-state-default ui-corner-all" style="margin:4px;"><span class="ui-icon ui-icon-grip-diagonal-se"></span></li>
    <p style="padding:5px; margin:0; font-weight:bold; font-size:20px;">功能列表</p>

    <ul id="menu" class="ui-menu ui-widget ui-widget-content" role="menu" tabindex="0" aria-activedescendant="ui-id-21">
        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="ui-menu-item"><a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["item"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</aside>

<section class="layout">
    <div class="content">
        


<div class="searchbar">
    <!--<form class="searchbar_form" id="search_product" action="/home/product/search" method="post">-->
    <div class="searchbar_form">
        <!--<form>-->
        <span>搜索编号/车型/名称: </span><input id="search_input" class="search_input" type="text" name="keyword"/>
        <button id="search_button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button">
            查询</button>
        <!--<input type="submit" value="搜索"/>-->
        <!--</form>-->
    </div>
    <!--</form>-->
</div>
<div id="search_result" class="search_result">

</div>
<script>

    $(document).bind('keydown', 'Ctrl+Z', function assets() {
        $("#search_input")[0].focus();
    });

    $("#search_input").focus(
            function(){
                $("#search_input").css("background-color","white");
                $("#search_input").css("border","1px solid #666");
            }
    );

    $("#search_input").blur(
            function(){
                $("#search_input").css("background-color","#eee");
                $("#search_input").css("border","1px solid white");
            }
    );

    $('#search_input').bind('keypress',function(event){
        if(event.keyCode == "13")
        {
            $("#search_button").click();
        }
    });

    $("#search_button").click(function(){
        var keyword = $("#search_input").val();
        $.post("/home/product/search_result?t=" + Math.random(),{keyword:keyword},function(result){
            $("#search_result").html(result);
        });
    });


</script>


    </div>
</section>

<script>
    $( "#menu" ).menu();
</script>
</body>
</html>