<?php

/**
 * @link http://blog.kunx.org/.
 * @copyright Copyright (c) 2016-12-21 
 * @license kunx-edu@qq.com.
 */

namespace Admin\Logic;

/**
 * Description of MysqlDB
 *
 * @author kunx <kunx-edu@qq.com>
 */
class MysqlDB implements DbMysqlInt {

    public function connect() {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    public function disconnect() {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    public function free($result) {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    public function getAll($sql, array $args = array()) {
        //获取实参列表
        $args = func_get_args();
        $tmpSql = $this->_buildSql($args);
        
        //获取结果集,二维数组
        return M()->query($tmpSql);
    }

    public function getAssoc($sql, array $args = array()) {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    public function getCol($sql, array $args = array()) {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    /**
     * 获取第一行的第一列数据
     * @param type $sql
     * @param array $args
     * @return scalar 标量类型.
     */
    public function getOne($sql, array $args = array()) {
        //获取实参列表
        $args = func_get_args();
        $tmpSql = $this->_buildSql($args);
        //获取结果集,二维数组
        $rst = M()->query($tmpSql);
        //获取第一行
        $row = array_shift($rst);
        //获取第一列
        $field = array_shift($row);
        return $field;
    }

    /**
     * 返回第一行记录,关联数组的方式
     * @param type $sql
     * @param array $args
     * @return array
     */
    public function getRow($sql, array $args = array()) {
        //获取实参列表
        $args = func_get_args();
        $tmpSql = $this->_buildSql($args);
        $rst = M()->query($tmpSql);
        //获取第一行记录
        return array_shift($rst);
    }

    /**
     * 执行插入操作,返回新记录的id
     * @param type $sql
     * @param array $args
     * @return integer|false
     */
    public function insert($sql, array $args = array()) {
        $args = func_get_args();
        //获取sql结构语句
        $sql = $args[0];
        //获取表名
        $tableName = $args[1];
        $sql = str_replace('?T', $tableName, $sql);
        $params = $args[2];
        $tmp_sql = [];
        foreach($params as $field=>$value){
            $tmp_sql[] = $field . '="' . $value . '"';
        }
        $tmp_sql = implode(',', $tmp_sql);
        $sql = str_replace('?%', $tmp_sql, $sql);
        $rst = M()->execute($sql);
        return M()->getLastInsID();
    }

    public function query($sql, array $args = array()) {
        //获取实参列表
        $args = func_get_args();
        $tmpSql = $this->_buildSql($args);
        //获取受影响的行数
        return M()->execute($tmpSql);
    }

    /**
     * @param type $sql
     * @param array $args
     * @return integer|false
     */
    public function update($sql, array $args = array()) {
        echo __METHOD__ . '<br/>';
        dump(func_get_args());
        echo '<hr />';
    }

    /**
     * 拼凑sql语句
     * @param array $args
     * @return string
     */
    private function _buildSql(array $args) {
        //获取sql结构
        $sql = array_shift($args);
        //通过占位分割sql结构语句
        $sql = preg_split('/\?[FNT]/', $sql);
        //删除sql结构数组中的多余元素
        array_pop($sql);
        //拼凑出完整的sql语句
        $tmpSql = '';
        foreach ($sql as $key=>$value){
            $tmpSql .= $value . $args[$key];
        }
        return $tmpSql;
    }
}
