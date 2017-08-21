<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/6 0006
 * Time: 10:10
 */

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller
{
    //js倒计时
    public function countdown(){
        $this->display();
    }
    //短信  验证码存数据库
    public function sms(){
        $code=rand(1,9).rand(1,9).rand(1,9).rand(1,9);
        $res=sendSms($_GET['phone'],$code);
        $this->ajaxReturn($res);
    }
    //视频上传腾讯云,本地，及上传格式验证
    public function video(){
        if(IS_POST){
            if (!empty($_FILES['video']['name'])) {
                $name = time() . '_' . rand(1000, 9999) . '.' . pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);
                $last_name = SITE_PATH . 'Upload/video/' . $name;
                $rs = move_uploaded_file($_FILES['video']['tmp_name'], $last_name);
//                上传腾讯云
                if ($rs) {
                    $video = unploadVod($last_name);
                }
                //普通保存
//                $video=$last_name;
                var_dump($video);exit;
            }
        }
        $this->display();
    }
    //上传多图
    public function morepic(){

        $this->display();
    }
    //百度分享
    public function baidushare(){
        $this->display();
    }
    //动画效果html5
    public function move(){
        $this->display('move');
    }
    //jquery cookie
    public function jqcookie(){
        $this->display('jqcookie');
    }
    //h5 表单
    public function formh5(){
        if(IS_POST){
            var_dump($_POST);exit;
        }
        $this->display('formh5');
    }
}