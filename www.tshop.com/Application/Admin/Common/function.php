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