<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/15 0015
 * Time: 下午 8:30
 */
//密码加密加盐方法
function tp_password($password,$salt){
    return md5(sha1(md5($password).$salt));
}
//上传单图的方法
function uploadone($file){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './';//设置附件上传根目录
    $upload->savePath  =      '/Upload/'; // 设置附件上传目录
    $upload->savaName  =     array('date','Y-m-d');//设置上传名
    // 上传单个文件
    $info   =   $upload->uploadOne($file);
    if(!$info) {
        // 上传错误提示错误信息
        $data['msg'] = $upload->getError();
    }else{
        // 上传成功 获取上传文件信息
        $data['path'] = $info['savepath'].$info['savename'];
        $data['small_path']=$info['savepath'].'80*80'.$info['savename'];
        $img = new \Think\Image(); //实例化
        $img->open(getcwd().$data['path']); //打开被处理的图片
        $img->thumb(100,100); //制作缩略图(100*100)
        $img->save(getcwd().$data['small_path']); //保存缩略图到服务器
    }
    return $data;
}
//图片缩略图  传入原图
function thumb($file){
    $image = new \Think\Image();
    $image->open($file);
    $thumbPath = $file.'_180'.'.gif';
    $image->thumb(180, 180)->save($thumbPath);
    return $thumbPath;
}