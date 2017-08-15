<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/16 0016
 * Time: 下午 9:03
 */

namespace Admin\Controller;


use Org\Util\String;
use Think\Controller;

class AdminController extends Controller
{
    //管理员列表
    public function index(){
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理员管理",
            's_title'=>"管理员列表"
        ];
        $this->assign('title',$title);
        $data=M("admin")->select();
        $this->assign('data',$data);
        $this->display('index');
    }
    //新增管理员
    public function add(){
        if(IS_POST){
            if($_FILES['photo']['name']){
                $photo=uploadone($_FILES['photo']);
                if($photo['path']){
                    $_POST['photo']=$photo['path'];
                    $_POST['thumb']=tp_thumb($_POST['photo']);
                }
            }
            $_POST['last_login_ip']=get_client_ip();
            $_POST['last_login_time']=time();
            $_POST['salt']=String::randString(6);
            $_POST['password']=tp_password($_POST['password'],$_POST['salt']);
            $res=M('admin')->add($_POST);
            if($res===false){
                $this->error('添加管理员信息失败');exit;
            }
            $data=[
                'admin_id'=>$res,
                'role_id'=>$_POST['role_id'],
            ];
            M('AdminRole')->add($data);
            $this->success('添加管理员成功',U('Admin/index'));exit;
        }
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理员管理",
            's_title'=>"新增管理员"
        ];
        $this->assign('roles',M('Role')->select());
        $this->assign('title',$title);
        $this->display();
    }
    //删除
    public function delete($id){
        $res=M('Admin')->find($id);
        if(empty($res)){
            $this->error('数据出错了');exit;
        }
        //先删除照片
        $front=getcwd();
        unlink($front.$res['thumb']);
        unlink($front.$res['photo']);
        M('Admin')->startTrans();
        //删除管理员 角色关联
        $result=M('AdminRole')->where(['admin_id'=>$id])->delete();
        if($result===false){
            M('Admin')->rollback();
            $this->error('删除失败',U('Admin/index'));exit;
        }
        $r=M('Admin')->delete($id);
        if($r===false){
            M('Admin')->rollback();
            $this->error('删除失败',U('Admin/index'));exit;
        }
        M('Admin')->commit();
        $this->success('删除成功',U('Admin/index'));exit;
    }
    //修改
    public function update($id){
        $row=M('admin a')->join('admin_role r on a.id=r.admin_id')->where(['id'=>$id])->find();
        if(empty($row)){
            $this->error('数据出错了',U('Admin/index'));exit;
        }
        if(IS_POST){
            if($_FILES['newphoto']['name']){
                $photo=uploadone($_FILES['newphoto']);
                if($photo['path']){
                    $_POST['photo']=$photo['path'];
                    $_POST['thumb']=tp_thumb($_POST['photo']);
                    if(!empty($_POST['oldphoto'])){
                        unlink(getcwd().$_POST['oldphoto']);
                    }
                    if(!empty($_POST['oldthumb'])){
                        unlink(getcwd().$_POST['oldthumb']);
                    }
                }
            }
            if(!empty($_POST['password'])){
                $_POST['salt']=String::randString(6);
                $_POST['password']=tp_password($_POST['password'],$_POST['salt']);
            }else{
                $_POST['password']=$row['password'];
            }
            $res=M('admin')->save($_POST);
            if($res!==1){
                $this->error('修改失败',U('admin/index'));exit;
            }
            $data=[
                'role_id'=>$_POST['role_id'],
            ];
            M('AdminRole')->where(['admin_id'=>$id])->save($data);
            $this->success('修改成功',U('admin/index'));exit;
        }
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"管理员管理",
            's_title'=>"修改管理员"
        ];
        $this->assign('roles',M('Role')->select());
        $this->assign('title',$title);
        $this->assign('row',$row);
        $this->display('update');
    }
}