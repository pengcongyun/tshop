<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15 0015
 * Time: 10:44
 */

namespace Admin\Model;


use Think\Model;

class PermissionModel extends Model
{
    public function getList(){
        return $this->order('lft')->select();
    }
    public function addPermission(){
        $orm=new \Admin\Logic\MysqlDB;
        $nestedsets=new \Admin\Logic\NestedSets($orm,$this->getTableName(),'lft','rgt','parent_id','id','level');
        if(!$catId=$nestedsets->insert($this->data['parent_id'],$this->data,'bottom')){
            $this->error='新建权限分类失败';
            return false;
        }else{
            return $catId;
        }
    }
    public function savePermission(){
        //判断是否修改了父级分类
        $currentPid=$this->data['parent_id'];
        //获取数据库原来的父级id
        $oldPid=$this->where(['id'=>$this->data['id']])->getField('parent_id');

        if($currentPid!=$oldPid){
            $orm=new \Admin\Logic\MysqlDB;
            $nestedsets=new \Admin\Logic\NestedSets($orm,$this->getTableName(),'lft','rgt','parent_id','id','level');
            if(!$nestedsets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom')){
                $this->error = '父级分类不合法';
                return false;
            }
        }
        return $this->save();
    }
    //删除方法
    public function deletePermission($id){
        //找到所有的后代分类
        $orm = new \Admin\Logic\MysqlDB;
        $nestedsets = new \Admin\Logic\NestedSets($orm, $this->getTableName(), 'lft', 'rgt', 'parent_id', 'id', 'level');
        $descendants = $nestedsets->getDescendants($id);
        //获取所有的后代分类id
        $ids = [];
//        var_dump($descendants);exit;
        foreach($descendants as $descendant){
            $ids[] = $descendant['id'];
        }
        if(empty($ids)){
            return true;
        }
        //删除关联的rolepermission表
        $rs=D('RolePermission')->where(['permission_id'=>['in',$ids]])->select();
        if(!empty($rs)){
            $count=D('RolePermission')->where(['permission_id'=>['in',$ids]])->delete();
            if(!$count){
                $this->error='删除关联表失败';exit;
            }
        }
        if(!D('Permission')->where(['id'=>['in',$ids]])->delete()){
            $this->error='删除失败';return false;
        }
        return true;
    }
}