<?php
/**
 * Yjgo Dao
 *
 * 登陆日志DAO
 *
 *
 * @category   Dao
 * @package    Dao_User_Login
 * @copyright  $Hearder: $
 * @author     $Author: doomsday $
 * @link       $Url: $
 * @version    $Id: Log.php 85 2017-01-16 10:36:57Z doomsday $
 */
class Dao_System_Log extends Aomp_Dao_Abstract
{
    public $_table = 'web_logs';

    public function addLog($domain = null, $message = null, $severity = null)
    {
        try {
            $this->db->insert($this->_table, array(
                    'domain' => $domain,
                    'message' => $message,
                    'severity' => $severity
            ));

            $id = $this->db->lastInsertId();
        }catch (Aomp_Dao_Exception $e){
            return false;
        }

        return $id;
    }
}