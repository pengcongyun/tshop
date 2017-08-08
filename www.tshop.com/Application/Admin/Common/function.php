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
//        $data['small_path']=$info['savepath'].'80-80'.$info['savename'];
//        $img = new \Think\Image(); //实例化
//        $img->open(getcwd().$data['path'])->thumb(80,80)->save(getcwd().$data['small_path']); //打开被处理的图片
    }
    return $data;
}
//图片缩略图  传入原图
function tp_thumb($file){
    $image = new \Think\Image();
    $ext=explode('.',$file);
    $thumbPath = $ext[0].'180_180.'.$ext[1];
    $image->open(getcwd().$file)->thumb(180,180)->save(getcwd().$thumbPath);
    return $thumbPath;
}
//将模型中的错误信息，转为一个有序的列表，返回错误字符串信息
function get_errors(\Think\Model $model){
    $errors=$model->getError();
    if(!is_array($errors)){
        $errors=[$errors];
    }
    $html='<ol>';
    foreach($errors as $error){
        $html.='<li>'.$error.'</li>';
    }
    $html.='</ol>';
    return $html;
}
/**
 * 发送curl请求
 * @param string $mobile
 */
function curl_post($url, $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $ret = curl_exec($curl);
    if (true != $ret) {
        $result = "{ \"result\":" . -2 . ",\"errmsg\":\"" . curl_error($curl) . "\"}";
    } else {
//        $rsp = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        $rsp = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($rsp != 200) {
            $result = "{ \"result\":" . -1 . ",\"errmsg\":\"" . $rsp . " " . curl_error($curl) . "\"}";
        } else {
            $result = $ret;
        }
    }
    curl_close($curl);
    return $result;
}

/**
 * 手机验证码发送---腾讯云
 * @param string $mobile
 */
function sendSms($tel, $code)
{
    //** 配置参数 */
    $AppID = "1400025722";
    $AppKey = "b8ddb57b5c184250c99f609bdc9cc6cf";
    $TemplateIDONE = "16234";  //短信验证
    $SMSsignature = "成都犬神科技";//短信签名
    $random = rand(1,10000000000000);//十位随机数
    $curTime = time();
    $url = sprintf("https://yun.tim.qq.com/v5/tlssmssvr/sendsms?sdkappid=%s&random=%s", $AppID, $random);//URL协议

    //签名加密
    $sig = hash("sha256", "appkey=" . $AppKey . "&random=" . $random . "&time=" . $curTime . "&mobile=" . $tel);

    //请求包体
    $smsBag = [
        "tel" => [
            "nationcode" => "86",
            "mobile" => $tel,
        ],
        'sign' => $SMSsignature,
        'tpl_id' => $TemplateIDONE,
        'params' => [
            "$tel",
            "$code",
            "5分钟",
        ],
        'sig' => $sig,
        'time' => time(),
        'extend' => "",
        'ext' => "",
    ];
    //发送请求
    $res = curl_post($url, $smsBag);
    $result = json_decode($res);
    return $result;
}
/*腾讯视频上传*/
function unploadVod($video)
{
    vendor('QcloudApi/VodUpload');
    $vod = new VodApi();
    $vod->Init("AKIDyG1uZo8bPzuZV8RJwQPopBNikTj38e1A", "oShHZQfBLnR5T6dSlZUSsxp3aZNUz43n", VodApi::USAGE_UPLOAD, "gz");

    $vod->SetConcurrentNum(20);    //设置并发上传的分片数目，不调用此函数时默认并发上传数为6
    $vod->SetRetryTimes(5);    //设置每个分片可重传的次数，不调用此函数时默认值为5

    // $package: 上传的文件配置参数
    $package = array(
        'fileName' => $video,                //文件的绝对路径，包含文件名
        'dataSize' => 1024 * 512,            //分片大小，单位Bytes。断点续传时，dataSize强制使用第一次上传时的值。
        'isTranscode' => 1,                    //是否转码
        'isScreenshot' => 0,                //是否截图
        'isWatermark' => 0,                    //是否添加水印
        'classId' => 0                        //分类
    );

    //$vod->AddFileTag("测试1");
    return $vod->UploadVideo($package);
}