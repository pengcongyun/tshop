<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3 0003
 * Time: 17:35
 */

namespace Admin\Controller;


use Think\Controller;

class GoodController extends Controller
{
    public function index(){
        $data=M('good')->select();
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"商品管理",
            's_title'=>"商品列表"
        ];
        $this->assign('title',$title);
        $this->assign('data',$data);
        $this->display('index');
    }
}