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

class Dao_Remote_Type extends Aomp_Dao_Abstract
{


    public $_table = 'type';

    /**
     *
     * @throws Aomp_Dao_Exception
     * @return boolean|Aomp_Dao_Recordset
     */
    public function getTypeAll()
    {
        $sql = <<<SQL
SELECT T.ID AS typeid, T.Type AS type, T.UserID AS userid, U.Name AS username, T.Name AS typename, T.CreateTime AS createtime
FROM {$this->_table} AS T
INNER JOIN `user` U ON T.UserID = U.ID
SQL;

        try {
            $rows = $this->db->fetchAll($sql);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Type');
    }

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean|Aomp_Dao_Recordset
     */
    public function getTypes($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('请选择类型');
            return false;
        }

        $where = array();
        $bind  = array();

        if(isset($condition['type'])){
            $where[] = 'T.Type = :type';
            $bind['type'] = $condition['type'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('请选择要查询的类型');
            return false;
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT T.ID AS typeid, T.Type AS type, T.UserID AS userid, U.Name AS username, T.Name AS typename, T.CreateTime AS createtime
FROM {$this->_table} T
LEFT JOIN `user` U ON T.UserID = U.ID
WHERE {$where}
SQL;

        try {

            $rows = $this->db->fetchAll($sql, $bind);

            return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Type');


        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param unknown $typeId
     * @throws Aomp_Dao_Exception
     * @return boolean|Dao_Remote_Record_Type
     */
    public function getType($typeId)
    {
        if(empty($typeId)){
            throw new Aomp_Dao_Exception('类型ID不能为空');
            return false;
        }

        $sql = <<<SQL
SELECT T.ID AS typeid, T.Type AS type, T.UserID AS userid, U.Name AS username, T.Name AS typename, T.CreateTime AS createtime
FROM {$this->_table} T
LEFT JOIN `user` U ON T.UserID = U.ID
WHERE T.ID = :ID LIMIT 1
SQL;

        try {
            $row = $this->db->fetchRow($sql, array('ID' => $typeId));

            return Aomp_Dao::record('Dao_Remote_Record_Type', $row);


        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean|string
     */
    public function createType($param)
    {
        if(empty($param)){
            throw new Aomp_Dao_Exception('数据不能为空');
            return false;
        }

        try {
            $this->db->insert($this->_table, array(
                'userid' => $param['userid'],
                'type'   => $param['type'],
                'name'   => $param['name']
            ));

            return $this->db->lastInsertId();
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }


    /**
     *
     * @param int $typeId
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function updateType($typeId, $param)
    {
        if(empty($typeId)){
            throw new Aomp_Dao_Exception('ID不能为空');
            return false;
        }

        if(empty($param) || !is_array($param)){
            throw new Aomp_Dao_Exception('修改信息错误');
            return false;
        }

        try {

            $this->db->update($this->_table, array('name' => $param['name'], 'userid' => $param['userid'], 'type' => $param['type']), array('ID = ' . $typeId));

            return true;
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}
