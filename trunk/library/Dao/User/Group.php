<?php
/**
 * Aomp Dao
 *
 * 管理员组DAO
 *
 *
 * @category   Dao
 * @package    Dao_User_Group
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */

class Dao_User_Group extends Aomp_Dao_Abstract
{

    /**
     *
     * @throws Aomp_Dao_Exception
     * @return Dao_User_Record_Group
     */
    public function getGroups()
    {
        $sql = <<<SQL
SELECT ID AS groupid, Name AS name, CreateTime AS createtime FROM `user_group`
SQL;
        try {
            $rows = $this->db->fetchAll($sql);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return array();

        }

        return new Aomp_Dao_Recordset($rows, 'Dao_User_Record_Group');
    }

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return Dao_User_Record_Group
     */
    public function getGroup($condition)
    {
        if(empty($condition)){
            return array();
        }

        $where = array();
        $bind = array();

        if(isset($condition['groupid']) && is_int($condition['groupid'])){
            $where[] = 'id = :id';
            $bind['id'] = $condition['groupid'];
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT ID AS groupid, Name AS name, CreateTime AS createtime FROM `user_group` WHERE {$where};
SQL;

        try {
            $row = $this->db->fetchRow($sql, $bind);

            return Aomp_Dao::record('Dao_User_Record_Group', $row);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return array();
        }
    }

    /**
     *
     * @param array $params
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function addGroup($params)
    {
        try {
            $this->db->insert('user_group', $params);

            return $this->db->lastInsertId();
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}