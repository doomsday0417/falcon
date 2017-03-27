<?php
/**
 * Aomp Framework
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @package    Aomp_Dao
 * @copyright  $Copyright: $
 * @author     $Author: $
 * @version    $Id: $
 */

abstract class Aomp_Dao_Abstract
{
    /**
     * Aomp_Db_Mysql object.
     *
     * @var Aomp_Db_Mysql
     */
    protected $db;

    /**
     * Aomp_Dao_Record
     *
     * @var string
     */
    private $_recordClass = 'Aomp_Dao_Record';

    final public function __construct($type = null)
    {
        //初始化DB
        $this->db = Aomp_Db::factory($type);
    }

    /**
     *
     * @param Exception $e
     * @param string $method
     */
    protected function _catchException(Exception $e, $method)
    {
        $log = Aomp_Yaf_ResourceManager::getResource('log');

        $log->addLog($e, 'Dao', $method);
    }
}