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
    public $session = '';

    public function __construct()
    {
        $this->session = Yaf_Session::getInstance();
    }

    /**
     * Factory for Model_Abstract classes.
     *
     * @param string $className
     * @param mixed $db
     * @return Aomp_Dao_Abstract
     */
    public function getDao($className, $db = null)
    {
        return Aomp_Dao::factory($className, $db);
    }
}