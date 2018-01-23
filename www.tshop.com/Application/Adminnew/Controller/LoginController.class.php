<?php
namespace Adminnew\Controller;
class LoginController extends BaseController
{
    public function login(){
        if(IS_POST){
            echo 11;exit;
        }
        $this->display();
    }
    public function logout(){

    }
}