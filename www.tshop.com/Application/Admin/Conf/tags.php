<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 下午 9:24
 */
return array(
    //表单令牌开启
    'view_filter'=>array('Behavior\TokenBuildBehavior'),
    //行为
    'action_begin'=>array('Admin\Behavior\CheckrbacBehavior'),
);