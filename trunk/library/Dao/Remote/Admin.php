<?php
/**
 * Aomp Dao
 *
 * 管理员DAO
 *
 *
 * @category   Dao
 * @package    Dao_Remote_Admin
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */
class Dao_Remote_Admin extends Aomp_Dao_Abstract
{
    private $_table = 'remote_admin';

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean|Aomp_Dao_Recordset
     */
    public function getAdmins($condition)
    {
        $where = array();
        $bind = array();

        if(isset($condition['userid']) && is_int($condition['userid'])){
            $where[] = 'UserID = :userid ';
            $bind['userid'] = $condition['userid'];
        }

        if(isset($condition['remoteid']) && $condition['remoteid']){
            $where[] = 'RemoteID = :remoteid';
            $bind['remoteid'] = $condition['remoteid'];
        }

        if(isset($condition['type'])){
            $where[] = 'Type = :type';
            $bind['type'] = $condition['type'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT ID AS adminid, UserID AS userid, RemoteID as remoteid, CreateTime AS createtime
FROM {$this->_table}
WHERE {$where}
SQL;

        try {
            $rows = $this->db->fetchAll($sql, $bind);

            return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Admin');

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function createAdmin($param)
    {
        try {
            $this->db->insert($this->_table, array(
                'userid' => $param['userid'],
                'remoteid' => $param['remoteid'],
                'type' => empty($param['type']) ? 'server' : $param['type']
            ));

            return true;
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function deleteAdmin($condition)
    {
        $where = array();

        if (isset($condition['userid']) && is_int($condition['userid'])){
            $where[] = 'UserID = ' . $condition['userid'];
        }

        if(isset($condition['remoteid']) && is_int($condition['remoteid'])){
            $where[] = 'RemoteID = ' . $condition['remoteid'];
        }

        if(isset($condition['type'])){
            $where[] = 'Type = ' . $condition['type'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        try {
            $this->db->delete($this->_table, $where);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}