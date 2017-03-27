<?php

class Dao_User_Log extends Aomp_Dao_Abstract
{
    public function addLog($userId)
    {
        $table = 'login_log';

        try {
            $this->db->insert($table, array('UserID' => $userId));
            return $this->db->lastInsertId();
        }catch (Aomp_Db_Exception $e){
            return false;
            throw new Aomp_Dao_Exception($e->getMessage());
        }
    }
}