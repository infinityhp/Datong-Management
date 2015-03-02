<?php if (!defined('THINK_PATH')) exit();?><div id="custom-content" class="white-popup-block" style="max-width:800px; margin: 20px auto; text-align:center;">
    <style>
        #custom-content img {max-width: 100%;margin-bottom: 10px;}
    </style>
    <?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($i % 2 );++$i;?><img src="/public/<?php echo ($img["image"]); ?>" /><?php endforeach; endif; else: echo "" ;endif; ?>
</div>