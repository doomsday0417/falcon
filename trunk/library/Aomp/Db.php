<?php
/**
 * Aomp_Db
 * @author $Author: doomsday $
 * @version $Id: Db.php 57 2016-11-20 18:00:35Z doomsday $
 */
class Aomp_Db
{
    public static function factory($type = null)
    {
        if(empty($type)) $type = 'aomp';

        $config = Yaf_Application::app()->getConfig()->db->$type;
        $class_name = 'Aomp_Db_' . ucfirst(strtolower($config->type));
        $db = $class_name::getInstance($config);
        return $db  ? $db : false;
    }
}