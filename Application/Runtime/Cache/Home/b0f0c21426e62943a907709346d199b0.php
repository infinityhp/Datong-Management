<?php if (!defined('THINK_PATH')) exit(); if($data['error'] == 1): ?><div style="text-align:center;"><p style="font-size:16px; padding:20px;"><?php echo ($data['error_message']); ?></p></div>
<?php else: ?>

    <table id="products_list" class="products_list" width="100%">
        <tr>
            <!--<th>ID</th>-->
            <th class="mobile_td" width="40">编码</th>
            <th class="mobile_td" width="40">名称</th>
            <th class="mobile_td" width="40">车型</th>
            <th width="40">产地</th>
            <th width="80">备注</th>
            <th width="20">仓位</th>
            <th width="20">库存</th>
            <th width="20">单位</th>
            <?php if($data['show_cost_price'] == 1): ?><th width="30">成本价</th><?php endif; ?>
            <th width="30">批发价</th>
            <th width="30">零售价</th>
            <th class="mobile_td" width="20">图片</th>
            <?php if($data['operate_product'] == 1): ?><th class="mobile_td" width="40">操作</th><?php endif; ?>
        </tr>
        <?php if(is_array($data['products_list'])): $i = 0; $__LIST__ = $data['products_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pd): $mod = ($i % 2 );++$i;?><tr class="data_line">
            <!--<td><?php echo ($pd["id"]); ?></td>-->
                <td class="mobile_td toggle_td"><?php echo ($pd["sku"]); ?></a></td>
                <td class="mobile_td toggle_td"><?php echo ($pd["name"]); ?></td>
                <td class="mobile_td toggle_td"><?php echo ($pd["car_type"]); ?></td>
                <td class="toggle_td"><?php echo ($pd["origin"]); ?></td>
                <td class="toggle_td"><?php echo ($pd["remark"]); ?></td>
                <td><?php echo ($pd["warehouse_position"]); ?></td>
                <td><?php echo ($pd["stock"]); ?></td>
                <td><?php echo ($pd["unit"]); ?></td>
            <?php if($data['show_cost_price'] == 1): ?><td>
                    <div class="sp_father"><span class="secret_price" style="display: none;"><?php echo ($pd["cost_price"]); ?></span>&nbsp;</div>
                </td><?php endif; ?>
                <td>
                    <div class="sp_father"><span class="secret_price" style="display: none;"><?php echo ($pd["wholesale_price"]); ?></span>&nbsp;</div>
                </td>
                <td><?php echo ($pd["retail_price"]); ?></td>
                <td class="mobile_td">
                    <?php if(!empty($pd["iid"])): ?><li class='ui-state-default ui-corner-all'>
                            <a  class='view_image' href='/home/product/view_image/pid/<?php echo ($pd["id"]); ?>'>
                            <span class='ui-icon ui-icon-zoomin'></span></a></li><?php endif; ?>
                </td>
            <?php if($data['operate_product'] == 1): ?><td class="mobile_td">
                    <li class="ui-state-default ui-corner-all edit_li">
                        <a href="/home/product/item/id/<?php echo ($pd["id"]); ?>" target="_blank"><span class="ui-icon ui-icon-circle-arrow-e"></span></a></li>
                    <li class="ui-state-default ui-corner-all delete_li"><a href='javascript:delete_product(<?php echo ($pd["id"]); ?>,"<?php echo ($pd["sku"]); ?>");' target="_blank">
                                    <span class="ui-icon ui-icon-closethick"></span></a></li>
                </td><?php endif; ?>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

    <script>
        $("tr:even").addClass("even_line"); //偶数行的背景色
        $("tr:odd").addClass("odd_line");   //奇数行的背景色

        $('.products_list .data_line').mouseover(function(){
            $(this).addClass("mouseover");
        }).mouseout(function(){
            $(this).removeClass("mouseover");
        })      // 数据航鼠标效果

        $('.products_list .data_line .toggle_td').click(function(){
            $(this.parentNode).toggleClass("toggle");
        })

        $('.view_image').magnificPopup({
            type: 'ajax',
            alignTop: true,
            overflowY: 'scroll' // as we know that popup content is tall we set scroll overflow by default to avoid jump
        });

        hide_secret_price();        //隐藏价格


        function hide_secret_price(){
            $(".secret_price").hide();
            $(".sp_father").click(function(){
    //            $( this).parent().parent().children().children().children('.secret_price').toggle();
                $( this).children('.secret_price').toggle();
            });
        }

        function delete_product(pid, sku){
            var q = '确认删除:' + sku + '？';
            if(confirm(q))
                location.href = '/home/product/delete/id/' + pid;
        }

        function view_image(pid){
            $.getJSON('/home/product/view_image/pid/' + pid, function(data){

            })
        }

    </script><?php endif; ?>