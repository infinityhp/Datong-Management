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
        

<class class="create_product">
    <p style="margin:10px; font-size:20px; font-weight:bold;">创建产品</p>
    <ul>
    <form action="/home/product/add" method="post"enctype="multipart/form-data" >
        <li>
            <label>编码: </label><input class="text_input" type="text" name="sku"/> (必填)
        </li>
        <li>
            <label>名称: </label><input id="name_input" class="text_input" type="text" name="name"/> (必填)
        </li>

        <li>
            <label>产地: </label><input id="origin_input" class="text_input" type="text" name="origin"/>
        </li>
        <li>
            <label>车型: </label><input id="car_type_input" class="text_input" type="text" name="car_type"/>
        </li>
        <li>
            <label>备注: </label><textarea type="text" name="remark"></textarea> (100字以下)
        </li>
        <li>
            <label>仓位: </label><input class="text_input" type="text" name="warehouse_position" style="width:80px;"/>
            <label style="float:none;">库存: </label><input class="text_input" type="text" name="stock" style="width:80px;"/> (数字)
        </li>
        <li>
            <label>单位: </label>
              <select name="unit">
                        <?php if(is_array($unit)): $i = 0; $__LIST__ = $unit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["unit"]); ?>"><?php echo ($vo["unit"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
        </li>

        <li>
            <label>进货价:</label><input class="text_input" type="text" name="cost_price"/> (必填, 数字)
        </li>
        <li>
            <label>批发价: </label><input class="text_input" type="text" name="wholesale_price"/> (必填, 数字)
        </li>
        <li>
            <label>零售价: </label><input class="text_input" type="text" name="retail_price"/> (必填, 数字)
        </li>
        <li>
            <label>图片: </label>
            <?php for($i = 0; $i<$img_num; $i++) { ?>
                <div class="upload_img" style="">
                    <input name="photo[]" type="file" style="border:none;  width:150px;" />
                </div>
            <?php } ?>
        </li>
        <li>
            <label style="clear:both;">操作:</label><input style="float:left;" class="submitbutton" type="submit" value="提交"/>
        </li>
    </form>
    </ul>
</class>
<script>
    $.getJSON('/home/product/get_autocomplete/field/name',function(data){
        var var_list = new Array();
        $.each(data, function(index, element){
            var_list.push(element.name);
        });
        $( "#name_input" ).autocomplete({
            source: var_list
        });
    });

    $.getJSON('/home/product/get_autocomplete/field/origin',function(data){
        var var_list = new Array();
        $.each(data, function(index, element){
            var_list.push(element.origin);
        });
        $( "#origin_input" ).autocomplete({
            source: var_list
        });
    });

    $.getJSON('/home/product/get_autocomplete/field/car_type',function(data){
        var var_list = new Array();
        $.each(data, function(index, element){
            var_list.push(element.car_type);
        });
        $( "#car_type_input" ).autocomplete({
            source: var_list
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