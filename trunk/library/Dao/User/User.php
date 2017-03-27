<?php
/**
 * Aomp Dao
 *
 * 用户表DAO
 *
 *
 * @category   Dao
 * @package    Dao_User_Passport
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */
class Dao_User_User extends Aomp_Dao_Abstract
{
    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return Dao_User_Record_User
     */
    public function getUser($condition)
    {
        if(empty($condition)){
            return array();
        }

        $where = array();
        $bind  = array();

        if(isset($condition['account'])){
            $where[] = 'account = :account';
            $bind['account']  = $condition['account'];
        }

        if(isset($condition['email'])){
            $where[] = 'email = :email';
            $bind['email']  = $condition['email'];
        }

        if(isset($condition['mobile']) && is_int($condition['mobile'])){
            $where[] = 'mobile = :mobile';
            $bind['mobile']  = $condition['mobile'];
        }

        if(isset($condition['userid']) && is_int($condition['userid'])){
            $where[] = 'id = :id';
            $bind['id']  = $condition['userid'];
        }


        $where = implode(' AND ', $where);

        $columns = 'ID AS userid, GroupID AS groupid, Account AS account, Password AS password, Nick AS nick, Name AS name, Mobile AS mobile, '
                 . 'Email AS email, IsDisable AS isdisable ';

        $table = 'user';

        $sql = <<<SQL
SELECT {$columns} FROM {$table} where {$where}
SQL;

        try {
            $row = $this->db->fetchRow($sql, $bind);
        }catch (Aomp_Dao_Exception $e){
            return array();
            throw new Aomp_Dao_Exception($e->getMessage());
        }

        return Aomp_Dao::record('Dao_User_Record_User', $row);

    }
}