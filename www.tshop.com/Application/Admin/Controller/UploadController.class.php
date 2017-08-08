<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4 0004
 * Time: 15:04
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Upload;

class UploadController extends Controller
{
    //裁剪
    public function cjupload(){
        if(IS_POST){
            if($_FILES['upload-file']['name']){
                $photo=uploadone($_FILES['upload-file']);
            }
        }
        $this->display('cjupload');
    }
    //图片上传
    public function upload()
    {
        //完成文件的上传
        $options = C('UPLOAD_SETTING.SETTING');
        $upload = new Upload($options);
        $fileInfo = $upload->upload();
        $fileInfo = array_pop($fileInfo);
        if ($fileInfo) {
            //上传成功，返回文件路径
            if(strnatcasecmp($upload->driver,'qiniu')==0){
                $url=$fileInfo['url'];
            }else{
                $url = C('UPLOAD_SETTING.URL_PREFIX') . $fileInfo['savepath'] . $fileInfo['savename'];
            }
            $data = [
                'status' => 1,
                'msg' => '上传成功',
                'url' => $url,
            ];
        } else {
            $data = [
                'status' => 0,
                'msg' => $upload->getError(),
                'url' => ''
            ];
        }
        $this->ajaxReturn($data);
    }
    //js删除图片
    public function delete($pic){
        $pic=str_replace('http://www.tshop.com/','/',$pic);
        $front=getcwd();
        $link=$front.$pic;
        $res=unlink($front.$pic);
        if($res===false){
            $data=[
                'status'=>1,
                'msg'=>'删除失败',
            ];
        }else{
            $data=[
                'status'=>2,
                'msg'=>'删除成功',
            ];
        }
        $this->ajaxReturn($data);
    }
    //获取当前的路径
    public function dir(){
        echo getcwd() . "<br/>";
        echo dirname(__FILE__);
    }
}