<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/16 0016
 * Time: 下午 9:03
 */

namespace Admin\Controller;


use Think\Controller;

class AdminController extends Controller
{
    //管理员列表
    public function index(){
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理员管理",
            's_title'=>"管理员列表"
        ];
        $this->assign('title',$title);
        $data=M("admin")->select();
        $this->assign('data',$data);
        $this->display('index');
    }
    //新增管理员
    public function add(){
        if(IS_POST){
            var_dump($_POST);var_dump($_FILES['photo']);exit;
        }
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理员管理",
            's_title'=>"新增管理员"
        ];
        $this->assign('title',$title);
        $this->display();
    }
}