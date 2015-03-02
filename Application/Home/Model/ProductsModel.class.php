<?php
/**
 * Created by PhpStorm.
 * User: wilkins
 * Date: 2014/12/31
 * Time: 22:13
 */

namespace Home\Model;
use Think\Model;
class ProductsModel extends Model
{

    protected $_auto  = array(
        array('c_time','time',Model::MODEL_INSERT,'function'),        //插入时填入当前时间
        array('l_time','time',Model::MODEL_BOTH,'function'),        //插入或更新时填入当前时间
    );
    protected $_validate = array(
        array('sku','','编码重复',Model::EXISTS_VALIDATE,'unique'),
        array('sku','require','编码不能为空'),
        array('name','require','名称不能为空'),
        array('cost_price','require','进货价不能为空'),
        array('cost_price','currency','进货价需要是价格数字'),
        array('wholesale_price','require','批发价不能为空'),
        array('wholesale_price','currency','批发价需要是价格数字'),
        array('retail_price','require','零售价不能为空'),
        array('retail_price','currency','零售价需要是价格数字'),
        array('remark','0,200','备注长度不得多于200个字符',Model::VALUE_VALIDATE,'length'),
        array('stock','number','库存需要是数字',Model::VALUE_VALIDATE),
    );

}