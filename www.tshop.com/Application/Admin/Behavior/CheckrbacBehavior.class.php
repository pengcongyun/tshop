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
        return;
        //当前路径
        $now_url=MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME;
        echo $now_url;
        //不用登录的路径
        $no_login_urls=array(
            'Admin/Login/login',
            'Admin/Upload/upload',
            'Admin/Upload/delete',
            'Admin/Upload/cjupload',
        );
        //免登陆
        if(in_array($now_url,$no_login_urls)){
            return;
        }
        //身份未过期
        $admin=cookie('admin');
        if(empty($admin)){
            redirect(U('Login/login'),3,'请先登录才能访问');exit;
        }
        //查看权限
        $cond = [
            'admin_id'=>$admin['id'],
        ];
        $permissions = M()->table('admin_role ar')->join('role_permission rp on ar.role_id=rp.role_id')->join('permission p ON p.id=permission_id')->where($cond)->getField('id,path');
        if(!in_array($now_url,$permissions)){
            redirect(U('Admin/Index/index'),3,'你么有权限,去首页吧');exit;
        }

//        var_dump($permissions);exit;
    }
}