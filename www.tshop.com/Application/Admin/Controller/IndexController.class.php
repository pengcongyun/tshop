<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页admin管理
    public function index(){
        $data=M("admin")->select();
        $this->assign('data',$data);
        $this->display('index');
    }
}