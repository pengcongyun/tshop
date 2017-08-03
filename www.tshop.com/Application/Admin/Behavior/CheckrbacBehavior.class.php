<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 下午 9:27
 */
namespace Admin\Behavior;
class CheckrbacBehavior extends \Think\Behavior
{

    /**
     * 执行行为 run方法是Behavior唯一的接口
     * @access public
     * @param mixed $params 行为参数
     * @return void
     */
    public function run(&$params)
    {
        // TODO: Implement run() method.
//        return;
        //当前路径
        $now_url=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        //不用登录的路径
        $no_login_urls=array(
            'Admin/Login/login',
        );
        //免登陆
        if(in_array($now_url,$no_login_urls)){
            return;
        }
        //身份未过期
        $admin=cookie('adminname');
        if(!empty($admin)){
            return;
        }
        else{
            redirect(U('Login/login'),3,'请先登录才能访问');exit;
        }
    }
}