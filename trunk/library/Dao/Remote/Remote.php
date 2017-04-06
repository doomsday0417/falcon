<?php
/**
 * Aomp Dao
 *
 * 主机DAO
 *
 *
 * @category   Dao
 * @package    Dao_Remote_Remote
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */
class Dao_Remote_Remote extends Aomp_Dao_Abstract
{
    const REMOTE_TYPE_CENTOS = 2;
    const REMOTE_TYPE_MYSQL  = 1;

    public $_table = 'remote';

    /**
     *
     * @throws Aomp_Dao_Exception
     * @return Aomp_Dao_Recordset|boolean
     */
    public function getRemoteAll()
    {

        $sql = <<<SQL
SELECT R.ID AS remoteid, RT.ID AS typeid, RT.Name AS typename, U.Name AS username, R.Name AS name, R.IP AS ip, R.IsDisable AS isdisable, R.CreateTime AS createtime
FROM {$this->_table} R
INNER JOIN `type` RT ON RT.ID = R.TypeID AND RT.Type = 'server'
LEFT JOIN `user` U ON U.ID = R.UserID
SQL;

        try {

            $rows = $this->db->fetchAll($sql);

            return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Remote');

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

    }

    public function getRemotes($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('信息有误');
            return false;
        }

        $where = array();
        $bind  = array();


        if(isset($condition['typeid']) && is_int($condition['typeid'])){
            $where[] = 'R.TypeID = :typeid';
            $bind['typeid'] = $condition['typeid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT R.ID AS remoteid, R.TypeID AS typeid, R.ID AS userid, R.Name AS name, U.Name AS username, R.IP AS ip, R.IsDisable AS isdisable, R.CreateTime AS createtime
FROM {$this->_table} R
INNER JOIN `user` U ON R.UserID = U.ID
WHERE {$where}
SQL;

        try {

            $row = $this->db->fetchAll($sql, $bind);

            return Aomp_Dao::record('Dao_Remote_Record_Remote', $row);

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     * 获取主机
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean|Dao_Remote_Record_Remote
     */
    public function getRemote($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('信息有误');
            return false;
        }

        $where = array();
        $bind  = array();

        if(isset($condition['remoteid']) && is_int($condition['remoteid'])){
            $where[] = 'R.ID = :ip';
            $bind['ip'] = $condition['remoteid'];
        }

        if(isset($condition['ip']) && is_int($condition['ip'])){
            $where[] = 'R.IP = :ip';
            $bind['ip'] = $condition['ip'];
        }

        if(isset($condition['typeid']) && is_int($condition['typeid'])){
            $where[] = 'R.TypeID = :typeid';
            $bind['typeid'] = $condition['typeid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT R.ID AS remoteid, R.TypeID AS typeid, R.ID AS userid, R.Name AS name, U.Name AS username, R.IP AS ip, R.IsDisable AS isdisable, R.CreateTime AS createtime
FROM {$this->_table} R
INNER JOIN `user` U ON R.UserID = U.ID
WHERE {$where} LIMIT 1
SQL;

        try {

            $row = $this->db->fetchRow($sql, $bind);

            return Aomp_Dao::record('Dao_Remote_Record_Remote', $row);

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     * 添加主机
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean|int
     */
    public function createRemote($param)
    {
        if(empty($param)){
            throw new Aomp_Dao_Exception('信息不能为空');
            return false;
        }

        $bind = array();

        if(isset($param['userid']) && is_int($param['userid'])){
            $bind['userid'] = $param['userid'];
        }

        if(isset($param['typeid']) && is_int($param['typeid'])){
            $bind['typeid'] = $param['typeid'];
        }

        if(isset($param['name'])){
            $bind['name'] = $param['name'];
        }

        if(isset($param['ip']) && is_int($param['ip'])){
            $bind['ip'] = $param['ip'];
        }

        if(empty($bind)){
            throw new Aomp_Dao_Exception('提交信息有误');
            return false;
        }

        try {

            $row = $this->db->insert($this->_table, $bind);

            $row = $this->db->lastInsertId();

            if(empty($row)){
                throw new Aomp_Dao_Exception('添加失败');
                return false;
            }

            return $row;

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }



    /**
     *
     * @param array $condition
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function updateRemote($condition, $param)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('信息有误');
            return false;
        }

        $where = array();

        if(isset($condition['remoteid']) && is_int($condition['remoteid'])){
            $where[] = 'ID = ' . $condition['remoteid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        try {

            $this->db->update($this->_table, $param, $where);

            return true;

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    public function deleteRemote($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = array();

        if(isset($condition['remoteid']) && is_int($condition['remoteid'])){
            $where[] = 'ID = ' . $condition['remoteid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不正确');
            return false;
        }

        try {

            $this->db->delete($this->_table, $where);

            return true;
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}