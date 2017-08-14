<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/14 0014
 * Time: 下午 10:14
 */
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
    public function login(){
        if(!empty(cookie('adminname'))){
            redirect(U('Index/index'));exit;
        }
        if(IS_POST){
            //验证数据
            if(D('admin')->create()===false){
                $this->error('数据出错了');exit;
            }
            //验证用户是否存在
            $data=D('admin')->where(['username'=>I('post.username')])->find();
            if(empty($data)){
                $this->error('用户名或者密码错误');exit;
            }
            //验证密码
            if(tp_password(I('post.password'),$data['salt'])!=$data['password']){
                $this->error('用户名或者密码错误');exit;
            }
            $res=D('admin')->where(['username'=>I('post.username')])->save(['last_login_time'=>time(),'last_login_ip'=>get_client_ip()]);
            //验证是否记住登录 存个4小时
            if(I('post.check')==1){
                cookie('admin',$data,4*60*60);
            }else{
                cookie('admin',$data,60*60);
            }
            $this->success('登录成功',U('Index/index'));exit;
        }
        $this->display('login');
    }
    public function logout(){
        session(null);
        cookie(null);
        $this->success('退出成功',U('Login/login'));exit;
    }
}