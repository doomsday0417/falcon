<?php
/**
 * Yjg Model
 *
 * LICENSE
 *
 *
 * @category   Model
 * @package    Model_Abstract
 * @copyright  $Header:  $
 * @link       $Url: $
 * @author     $Author:  $
 * @version    $Id: $
 */

abstract class Model_Abstract
{
    protected $session;

    /**
     *
     * @var Aomp_Application_Resource_Memcache
     */
    protected $memcache;

    public function __construct()
    {
        $this->session = Yaf_Session::getInstance();
        $this->memcache = Aomp_Yaf_ResourceManager::getResource('memcache');
    }

    /**
     * Factory for Model_Abstract classes.
     *
     * @param string $className
     * @param mixed $db
     * @return Aomp_Dao_Abstract
     */
    protected function getDao($className, $db = null)
    {
        return Aomp_Dao::factory($className, $db);
    }
}