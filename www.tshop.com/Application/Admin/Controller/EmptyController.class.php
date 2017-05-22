<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/22 0022
 * Time: 下午 8:33
 */

namespace Admin\Controller;


use Think\Controller;

class EmptyController extends Controller
{
    function _empty(){
        layout(false);
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
    }
    function index(){
        layout(false);
        header("HTTP/1.0 404 Not Found");
        $this -> display("Public:404");
    }
}