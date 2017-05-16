<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    //首页admin管理
    public function index(){
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理后台",
            's_title'=>"后台首页"
        ];
        $this->assign('title',$title);
        $this->display();
    }
}