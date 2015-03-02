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
        

<class class="">
    <p style="margin:10px; font-size:20px; font-weight:bold;">回收站</p>

    <table id="products_list" class="products_list" width="1200">
        <tr>
            <th width="40">编码</th><th width="40">名称</th>
            <th width="40">车型</th><th width="40">产地</th><th width="40">备注</th>
            <th width="20">仓位</th><th width="20">库存</th><th width="20">单位</th>
            <th width="30">成本价</th><th width="30">批发价</th><th width="30">零售价</th>
        </tr>
        <?php if(is_array($re_prod)): $i = 0; $__LIST__ = $re_prod;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pd): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($pd["sku"]); ?></td>
            <td><?php echo ($pd["name"]); ?></td>
            <td><?php echo ($pd["car_type"]); ?></td><td><?php echo ($pd["origin"]); ?></td><td><?php echo ($pd["remark"]); ?></td>
            <td><?php echo ($pd["warehouse_position"]); ?></td><td><?php echo ($pd["stock"]); ?></td>
                <td><?php echo ($pd["unit"]); ?></td>
            <td><?php echo ($pd["cost_price"]); ?></td><td><?php echo ($pd["wholesale_price"]); ?></td><td><?php echo ($pd["retail_price"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
<script>
    $("tr:even").addClass("even_line");//偶数行的背景色
    $("tr:odd").addClass("odd_line");//奇数行的背景色
</script>

</class>
    </div>
</section>

<script>
    $( "#menu" ).menu();
</script>
</body>
</html>