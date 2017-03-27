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
LEFT JOIN `group_power` GP ON UG.ID = GP.GroupID
LEFT JOIN `power` P ON P.ID = GP.PowerID
WHERE {$where} ORDER BY P.Sort desc
SQL;

        try {
            $rows = $this->db->fetchAll($sql, $bind);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return new Aomp_Dao_Recordset($rows, 'Dao_Power_Record_GroupPower');
    }
}