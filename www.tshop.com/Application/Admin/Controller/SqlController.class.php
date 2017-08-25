<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/25 0025
 * Time: 16:31
 */

namespace Admin\Controller;


use Think\Controller;

class SqlController extends Controller
{
    //插入数据
    public function inserts(){
        $conn=mysqli_connect("127.0.0.1",'root','root','tshop')or die('error');
        mysqli_query($conn,'set names utf8');
        //可以限制数据，防止数据过大  limit 10;
        $sql="select * from `good`";
        $result=mysqli_query($conn,$sql);
        $data=[];
        foreach($result as $k=>$v){
            $data[]=$v;
        }
        //总条数
        foreach($data as $v){
            //添加
            $name=$v['name'];
            $desc=$v['description'];
            $sql1="insert into goodcopy VALUE ('','{$name}','{$desc}')";
            mysqli_query($conn,$sql1);
            //删除源表
            $sql2="delete from good where id=".$v['id'];
            mysqli_query($conn,$sql2);
        }
        var_dump('ok');exit;
    }
    //

}