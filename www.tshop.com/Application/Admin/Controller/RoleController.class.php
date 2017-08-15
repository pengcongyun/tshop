<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15 0015
 * Time: 10:22
 */

namespace Admin\Controller;


use Think\Controller;

class RoleController extends Controller
{
    public function index(){
        $data=M('role')->select();
        $this->assign('data',$data);
        $this->display('index');
    }
    //添加
    public function add(){
        if(IS_POST){
            if(!$data=D('Role')->create()){
                $this->error(get_errors(D('Role')));exit;
            }
//            var_dump($data);exit;
            if(!D('Role')->addRole()){
                $this->error(get_errors(D('Role')));exit;
            }
            $this->success('添加成功',U('index'));exit;
        }
        $permissions=D('Permission')->getList();
        $this->assign('permissions',json_encode($permissions));
        $this->display('add');
    }
    //修改
    public function edit($id){
        if(IS_POST){
            if(!D('Role')->create()){
                $this->error(get_errors(D('Role')));exit;
            }
            if(!D('Role')->editRole($id)){
                $this->error(get_errors(D('Role')));exit;
            }
            $this->success('修改成功',U('index'));exit;
        }
        $this->assign('row',D('Role')->getRoleInfo($id));
        $permissions=D('Permission')->getList();
        $this->assign('permissions',json_encode($permissions));
        $this->display('add');
    }
    public function delete($id){
        $row=M('Role')->find($id);
        if(empty($row)){
            $this->error('数据出错了');exit;
        }
        if(D('Role')->deleteRole($id)===false){
            $this->error('删除失败');exit;
        }
        $this->success('删除成功');
    }
}