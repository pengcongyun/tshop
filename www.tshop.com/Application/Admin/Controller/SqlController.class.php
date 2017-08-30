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
    //数据表导出
    public function export(){
// 导出数据到excel表的路径
        $excelPath = __DIR__.'/dbsource.xlsx';
        vendor('excel.PHPExcel');

        // 需要将admin数据表中的数据导入到Excel表中
        $rows = M('role')->select();

        // 1. 新建excel表
        $excel = new \PHPExcel();
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('admin数据备份');
        $sheet->setCellValue('A1', '角色id')
            ->setCellValue('B1', '角色名称')
            ->setCellValue('C1','描述');

        // 第一行是表头，第二行开始导入Excel表中
        $line = 1;
        foreach ($rows as $field) {
            $line++;
            $sheet->setCellValue('A'.$line, $field['role_id'])
                ->setCellValue('B'.$line, $field['name'])
                ->setCellValue('C'.$line, $field['intro']);
        }
        $excel2007 = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $res=$excel2007->save($excelPath);
        echo '导出成功';exit;
    }
    //导入表

    //sql查询
    public function search(){
        $where=[];
        $datas1=M('admin')->field("b.*,admin.password as pwd")->where($where)->join("admin_role as b ON admin.id=b.admin_id")->select();
        $this->assign('datas1',$datas1);
        $this->display();
    }
}