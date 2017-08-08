<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/3 0003
 * Time: 17:35
 */

namespace Admin\Controller;


use Think\Controller;
use Think\Page;

class GoodController extends Controller
{
    //列表
    public function index(){
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"商品管理",
            's_title'=>"商品列表"
        ];
        $page=new Page(M('good')->count(),2);
        $page->listRows=2;
        $data=M()->table(array('good'=>'g','category'=>'c'))->field('g.id,g.name,g.sex,g.hobby,g.pic,g.description,c.catename')->where('g.category_id=c.cid')->limit($page->firstRow,$page->listRows)->select();
        $this->assign('title',$title);
        $this->assign('data',$data);
        $this->assign('page',$page->show());
        $this->display('index');
    }
    //添加
    public function add(){
        $title=[
            'b_title'=>"管理首页",
            'm_title'=>"商品管理",
            's_title'=>"添加商品"
        ];
        if(IS_POST){
            if(D('good')->create()===false){
                $this->error(get_errors(D('good')));exit;
            }
            if($_FILES['pic']['name']){
                $photo=uploadone($_FILES['pic']);
                if($photo['path']){
                    $_POST['pic']=$photo['path'];
                }
            }
            $_POST['hobby']=array_sum($_POST['hobby']);
            if(!M('good')->add($_POST)){
                $this->error('添加失败',U('good/index'));exit;
            }
            $this->success('添加成功',U('good/index'));exit;
        }
        $this->assign('title',$title);
        $this->assign('cate',M('category')->select());
        $this->display('add');
    }
    //修改
    public function update($id){
        var_dump($_GET);exit;
    }
    //删除
    public function delete(){
        $id=$_GET['id'];
        $p=$_GET['p'];
        $row=M('good')->find($id);
        if(empty($row)){
            $this->error('数据出错了');exit;
        }
        if(M('good')->delete($id)!==1){
            $this->error('删除失败',U('good/index',['p'=>$p]));exit;
        }
        $this->success('删除成功',U('good/index',['p'=>$p]));exit;
    }
}