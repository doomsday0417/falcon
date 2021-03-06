<?php
/**
 * Aomp Dao
 *
 * 权限DAO
 *
 *
 * @category   Dao
 * @package    Dao_User_Passport
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */

class Dao_Power_Power extends Aomp_Dao_Abstract
{
    private $_table = 'power';

    /**
     *
     * @throws Aomp_Dao_Exception
     * @return Dao_Power_Record_Power
     */
    public function getPowerAll()
    {
        $sql = <<<SQL
SELECT ID AS powerid, PowerName AS powername, PowerClass AS powerclass, Sort AS sort, CreateTime AS createtime FROM {$this->_table}
SQL;

        try {
            $rows = $this->db->fetchAll($sql);
        } catch (Aomp_Db_Exception $e) {
            throw new Aomp_Dao_Exception($e->getMessage());
            return array();
        }

        return new Aomp_Dao_Recordset($rows, 'Dao_Power_Record_Power');
    }

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return Dao_Power_Record_Power
     */
    public function getPower($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('查询条件不能为空');
            return array();
        }

        $where = array();
        $bind = array();

        if(isset($condition['powerid']) && is_int($condition['powerid'])){
            $where[] = 'ID = :id';
            $bind['id'] = $condition['powerid'];
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT ID AS powerid, PowerName AS powername, PowerClass AS powerclass, Sort AS sort, CreateTime AS createtime FROM {$this->_table} WHERE {$where}
SQL;

        try {
            $row = $this->db->fetchRow($sql, $bind);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return Aomp_Dao::record('Dao_Power_Record_Power');
        }

        return Aomp_Dao::record('Dao_Power_Record_Power', $row);
    }

    /**
     *
     * @param array $params
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function addPower($params)
    {
        try {
            $this->db->insert($this->_table, array(
                'PowerName' => $params['powername'],
                'PowerClass' => $params['powerclass'],
                'Sort' => $params['sort']
            ));

            return $this->db->lastInsertId();
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
    public function updatePower($condition, $param)
    {
        if(empty($condition) || !is_array($condition) || empty($param) || !is_array($param)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = array();
        $bind = array();

        if(isset($condition['powerid']) && is_int($condition['powerid'])){
            $where[] = 'ID = ' . $condition['powerid'];
        }

        if(isset($param['name'])){
            $bind['PowerName'] = $param['name'];
        }

        if(isset($param['powerclass'])){
            $bind['PowerClass'] = $param['powerclass'];
        }

        if(isset($param['sort']) && is_int($param['sort'])){
            $bind['Sort'] = $param['sort'];
        }

        if(empty($where) || empty($bind)){
            throw new Aomp_Dao_Exception('数据不能为空');
            return false;
        }

        try{
            $this->db->update($this->_table, $bind, $where);

            return true;
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param int $powerId
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function deletePower($powerId)
    {
        try {
            $this->db->delete($this->_table, array('ID' => $powerId));
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return true;
    }


}