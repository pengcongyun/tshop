<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/5 0005
 * Time: 14:14
 */
namespace Admin\Model;
class GoodModel extends \Think\Model
{
    protected $_validate = array(
        ['name','/^1[34578]\d{9}$/','请输入正确的名称',1,'regex',3],
    );
}