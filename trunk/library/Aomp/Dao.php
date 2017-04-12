<?php
/**
 * Aomp
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @package    Aomp_Dao
 * @copyright  $Copyright: $
 * @link
 * @author     $Author: $
 * @version    $Id:  $
 */
abstract class Aomp_Dao
{
    /**
     * Factory for Aomp_Dao_Abstract classes.
     *
     * @param string $className
     * @param mixed $db
     * @return Yjgo_Dao_Abstract
     */
    public static function factory($className, $db = null)
    {
        return new $className($db);
    }

    /**
     * Factory for Aomp_Dao_Record classes.
     *
     * @param string $recordClass
     * @param array $fields
     * @param Boolean $allowModifications
     * @return Aomp_Dao_Record
     */
    public static function record($recordClass, $fields = array(), $allowModifications = true)
    {
        return new $recordClass($fields, $allowModifications);
    }
}