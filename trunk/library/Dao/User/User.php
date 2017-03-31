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
    private $_table = 'user';

    public function getUserAll()
    {
        $columns = 'U.ID AS userid, U.GroupID AS groupid, UG.Name AS groupname, U.Account AS account, U.Password AS password, U.Nick AS nick, U.Name AS name, U.Mobile AS mobile, '
            . 'U.Email AS email, U.IsDisable AS isdisable, U.CreateTime AS createtime ';

        $table = $this->_table . ' AS U '
               . 'INNER JOIN user_group UG ON U.GroupID = UG.ID ';
        $sql = <<<SQL
SELECT {$columns} FROM {$table}
SQL;

        try{
            $rows = $this->db->fetchAll($sql);

            return new Aomp_Dao_Recordset($rows, 'Dao_User_Record_User');
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
        }
    }

    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return Dao_User_Record_User
     */
    public function getUser($condition)
    {
        if(empty($condition)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
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

        if(empty($condition)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }


        $where = implode(' AND ', $where);

        $columns = 'ID AS userid, GroupID AS groupid, Account AS account, Password AS password, Nick AS nick, Name AS name, Mobile AS mobile, '
                 . 'Email AS email, IsDisable AS isdisable, CreateTime AS createtime';


        $sql = <<<SQL
SELECT {$columns} FROM {$this->_table} where {$where}
SQL;

        try {
            $row = $this->db->fetchRow($sql, $bind);
        }catch (Aomp_Dao_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return Aomp_Dao::record('Dao_User_Record_User', $row);

    }

    /**
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return string|boolean
     */
    public function createUser($param)
    {
        try {
            $this->db->insert($this->_table, $param);
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
    public function updateUser($condition, $param)
    {
        if(empty($condition) || empty($param)){
            throw new Aomp_Dao_Exception('数据不能为空');
            return false;
        }

        $where = array();

        if(isset($condition['userid']) && is_int($condition['userid'])){
            $where[] = 'ID = '. $condition['userid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        try {
            $this->db->update($this->_table, $param, $where);
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param int $userId
     * @throws Aomp_Dao_Exception
     * @return boolean
     */
    public function deleteUser($userId)
    {
        try {
            return $this->db->delete($this->_table, array('ID = ' . $userId));
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}