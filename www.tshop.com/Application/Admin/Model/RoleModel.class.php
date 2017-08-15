<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15 0015
 * Time: 14:49
 */

namespace Admin\Model;


use Think\Model;

class RoleModel extends Model
{
    public function addRole(){
        //开启事务
        $this->startTrans();
        //添加角色记录
        $role_id=D('Role')->add();
        //添加角色关联
//        var_dump($role_id);exit;
        $permission_ids=I('post.permission_id');
//        var_dump($permission_ids);exit;
        //如果没有什么权限，就返回
        if(empty($permission_ids)){
            return true;
        }
        $data=[];
        foreach($permission_ids as $permission_id){
            $data[]=[
                'role_id'=>$role_id,
                'permission_id'=>$permission_id,
            ];
        }
        $res=D('RolePermission')->addAll($data);
        if($res===false){
            $this->error='添加角色权限错误';
            //回滚
            $this->rollback();
            return false;
        }
        $this->commit();
        return $res;
    }
    public function getRoleInfo($id){
        $row=D('Role')->find($id);
        $permission_ids=D('RolePermission')->where(['role_id'=>$id])->getField('permission_id',true);
        $permission_ids=json_encode($permission_ids);
        $row['permission_ids']=$permission_ids;
        return $row;
    }
    //编辑
    public function editRole($id){
        $this->startTrans();
        $res=D('Role')->where(['role_id'=>$id])->save();
        if($res===false){
            $this->error='修改角色失败';
            $this->rollback();
            return false;
        }
        //删除原来的关联关系
        D('RolePermission')->where(['role_id'=>$id])->delete();
        //添加角色关联
        $permission_ids=I('post.permission_id');
        //如果没权限，就返回成功
        if(empty($permission_ids)){
            return true;
        }
        $data=[];
        foreach($permission_ids as $permission_id){
            $data[]=[
                'role_id'=>$id,
                'permission_id'=>$permission_id,
            ];

        }
        $re=D('RolePermission')->addAll($data);
        if($re===false){
            $this->error='添加角色权限错误';
            $this->rollback();
            return false;
        }
        return $re;
    }
    //删除方法
    public function deleteRole($id){
        //删除角色权限关联表，和管理员角色关联表
        D('RolePermission')->where(['role_id'=>$id])->delete();
        D('AdminRole')->where(['role_id'=>$id])->delete();
        //删除当前表的数据
        return $this->delete($id);
    }
    //
    public function getList(){
        return $this->order('sort')->select();
    }
}