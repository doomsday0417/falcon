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

class Dao_Power_GroupPower extends Aomp_Dao_Abstract
{
    private $_table = 'group_power';

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean|Aomp_Dao_Recordset
     */
    public function getGroupPowers(array $condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = array();
        $bind = array();

        if(isset($condition['groupid']) && is_int($condition['groupid'])){
            $where[] = 'UG.ID = :id';
            $bind['id'] = $condition['groupid'];
        }

        $columns= 'UG.ID AS groupid, P.PowerName AS powername, P.PowerClass AS powerclass, GP.Power AS power';

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT {$columns}
FROM `user_group` UG
INNER JOIN {$this->_table} GP ON UG.ID = GP.GroupID
INNER JOIN `power` P ON P.ID = GP.PowerID
WHERE {$where} ORDER BY P.Sort DESC
SQL;

        try {
            $rows = $this->db->fetchAll($sql, $bind);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return new Aomp_Dao_Recordset($rows, 'Dao_Power_Record_GroupPower');
    }

    /**
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function addGroupPowers($param)
    {
        try {
            $this->db->insert($this->_table, array(
                'groupid' => $param['groupid'],
                'powerid' => $param['powerid'],
                'power'   => $param['power']
            ));
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return true;
    }


    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function deleteGroupPowers($condition)
    {
        if( empty($condition) || !is_array($condition) ){
            throw new Aomp_Dao_Exception('条件错误');
            return false;
        }

        $where = array();

        if(isset($condition['groupid']) && is_int($condition['groupid'])){
            $where[] = 'groupid = ' . $condition['groupid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        try {
            return $this->db->delete($this->_table, $where);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}