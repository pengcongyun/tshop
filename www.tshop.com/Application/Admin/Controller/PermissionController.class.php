<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15 0015
 * Time: 10:44
 */

namespace Admin\Controller;


use Think\Controller;

class PermissionController extends Controller
{
    public function index(){
        $this->assign('data',D('Permission')->getList());
        $this->display('index');
    }
    public function add(){
        if(IS_POST){
            if(D('Permission')->create()===false){
                $this->error(get_errors(D('Permission')));exit;
            }
            //执行添加
            if(D('Permission')->addPermission()===false){
                $this->error(get_errors(D('Permission')));exit;
            }
            $this->success('添加成功',U('add'));exit;
        }
        $this->_beforeView();
        $this->display('add');
    }
    public function edit(){
        $id=$_GET['id'];
        $row=M('Permission')->find($id);
        if(empty($row)){
            $this->error('数据出错了');exit;
        }
        if(IS_POST){
            if(D('Permission')->create()===false){
                $this->error(get_errors(D('Permission')));exit;
            }
            //执行修改
            if(D('Permission')->savePermission()===false){
                $this->error(get_errors(D('Permission')));exit;
            }
            $this->success('修改成功',U('index'));exit;
        }
        $this->_beforeView();
        $this->assign('row',$row);
        $this->display('add');
    }
    public function delete($id){
        $row=M('Permission')->find($id);
        if(empty($row)){
            $this->error('数据出错了');exit;
        }
        if(!D('Permission')->deletePermission($id)){
            $this->error('删除失败',U('index'));exit;
        }
        $this->success('删除成功',U('index'));
    }
    private function _beforeView(){
        $categories=D('Permission')->getList();
        array_unshift($categories,['id'=>0,'name'=>'顶级分类']);
        $this->assign('categories',$categories);
    }
}