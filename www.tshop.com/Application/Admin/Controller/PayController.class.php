<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/16 0016
 * Time: 14:13
 */

namespace Admin\Controller;


use Think\Controller;

class PayController extends Controller
{
    public function pay(){
        if(IS_POST){
            $money=$_POST['money'];
            dump($money);exit;
        }
        $this->display();
    }
}