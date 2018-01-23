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
    public function baidushare2(){
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
    //ajax抽奖
    public function price(){
        if(IS_AJAX){
            $prize_arr = array(
                '0' => array('id'=>1,'min'=>1,'max'=>29,'prize'=>'一等奖','v'=>1),
                '1' => array('id'=>2,'min'=>302,'max'=>328,'prize'=>'二等奖','v'=>2),
                '2' => array('id'=>3,'min'=>242,'max'=>268,'prize'=>'三等奖','v'=>5),
                '3' => array('id'=>4,'min'=>182,'max'=>208,'prize'=>'四等奖','v'=>7),
                '4' => array('id'=>5,'min'=>122,'max'=>148,'prize'=>'五等奖','v'=>10),
                '5' => array('id'=>6,'min'=>62,'max'=>88,'prize'=>'六等奖','v'=>25),
                '6' => array('id'=>7,'min'=>array(32,92,152,212,272,332),
                    'max'=>array(58,118,178,238,298,358),'prize'=>'七等奖','v'=>50)
            );
//抽奖开始
            foreach ($prize_arr as $key => $val) {
                $arr[$val['id']] = $val['v'];
            }
            $rid = $this->getRand($arr); //根据概率获取奖项id
            $res = $prize_arr[$rid-1]; //中奖项
            $min = $res['min'];
            $max = $res['max'];
            if($res['id']==7){ //七等奖
                $i = mt_rand(0,5);
                $result['angle'] = mt_rand($min[$i],$max[$i]);
            }else{
                $result['angle'] = mt_rand($min,$max); //随机生成一个角度
            }
            $result['prize'] = $res['prize'];

            echo json_encode($result);exit;
        }
        $this->display('price');
    }
    public function getRand($proArr) {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }
    //幻灯片播放
    public function lightshow(){
//        $this->display();
        $this->display('lightshow1');
    }
    //js 休眠
    public function jssleep(){
        $this->display();
    }
    //获取查询，执行的时间
    public function querytime(){
        $stime=microtime(true);
        $data=M('admin')->select();
        $etime=microtime(true);
        $total=$etime-$stime;
        $this->assign('total',$total);
        $this->display();
    }
    //遮罩层
    public function zhezhao(){
        $this->display();
    }
    //固定在顶部
    public function topfix(){
        $this->display();
    }
    //前端验证码
    public function captcha(){
//        $this->display();
        $this->display('captcha');
    }
    //前端验证码新
    public function captchas(){
        $this->display();
    }
    //jsonp
    public function jsonp(){
        $this->display();
    }
    //jsonp2
    public function jsonp2(){
        if(IS_AJAX){
            $a=file_get_contents('http://588ku.com/sucai/0-pxnum-0-0-0-1/?h=bd&sem=1');
            preg_match_all('/<img[^>]*>/i', $a, $match);
            echo json_encode($match);exit;
        }
        $this->display();
    }
    //redis
//    public function redis(){
//        if(!empty(S('new_goods'))){
//            $data=S('new_goods');
//        }else{
//            $data=M('role')->select();
//            S('new_goods',$data,300);
//        }
//        var_dump($data);exit;
//    }
    //测试jQuerycode
    public function jqcode(){
        $this->display();
    }
    /**
     * 数组 转 对象
     *
     * @param array $arr 数组
     * @return object
     */
    function array_to_object($arr) {
        if (gettype($arr) != 'array') {
            return;
        }
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = (object)($v);
            }
        }

        return (object)$arr;
    }
    /**
     * 对象 转 数组
     *
     * @param object $obj 对象
     * @return array
     */
    function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)($v);
            }
        }

        return $obj;
    }
    public function ob_arr(){
        $arr=[1,3,4,5];
        $arr2=$this->array_to_object($arr);
        $arr3=$this->object_to_array($arr2);
        var_dump($arr2);
        echo "<br>";
        var_dump($arr3);exit;
    }
    //ip获取
    public function Iplocation(){
        $ip = $_SERVER["REMOTE_ADDR"];//获取客户端IP
        $info = (new Location()) -> GetIpLookup('222.74.21.206');//将ip换成$ip
        dump($info);
    }
    //js图像验证码
    public function jscode(){
//        $this->display('jscode');
        $this->display('jscode2');
    }
    //ajax头像上传
    public function avatar(){
        $this->display();
    }
    //ajax多图上传
    public function avatarmore(){
        $this->display();
    }
    //图像剪切上传
    public function cutpic(){
        if(IS_POST){
            $base_img = explode('base64,',$_POST['data'])[1];
            $path = "./Upload/avatar/";
            $output_file = time().'.jpg';
            $path = $path.$output_file;
            //创建将数据流文件写入我们创建的文件内容中
            $ifp = fopen( $path, "wb" );
            fwrite( $ifp, base64_decode( $base_img) );
            fclose( $ifp );
            $result=[
                'status'=>1,
            ];
            echo json_encode($result);exit;
        }
        $this->display();
    }
    //cookie实现多长时间刷新页面
    public function f5(){
        if(!empty(cookie('gg'))){
            cookie('gg',22,1*60);
        }else{
            cookie('gg',11,1*60);
        }
        $this->assign('xx',$_COOKIE['www_tshop_com_gg']);
        $this->display();
    }
    //js实现点击添加一行，删除
    public function adddel(){
        $this->display();
    }
    //上传多图ajax
    public function addmorepic(){
        $this->display();
    }
}