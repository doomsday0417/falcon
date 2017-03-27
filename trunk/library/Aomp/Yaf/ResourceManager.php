<?php
/**
 * Aomp_Yaf_ResourceManager
 *
 * LICENSE
 *
 * @author  $Author:  $
 * @version $Id:  $
 */

/**
 * 基于Yaf实现配置文件中的资源管理
 *
 */

class Aomp_Yaf_ResourceManager
{
    /**
     *
     * @var array
     */
    protected static $_options = array();

    /**
     *
     * @var string
    */
    protected static $_resources;

    protected function __construct()
    {
    }

    /**
     *
     * @param array $options
     * @return Backend_Server_ResourceManager
     */
    public static function addOptions($options)
    {
        foreach ($options as $k => $v) {
            self::$_options[$k] = $v;
        }
    }

    public static function getResource($resource)
    {
        if (!isset(self::$_resources[$resource])) {

            if (!isset(self::$_options[$resource])) {
                require "Aomp/Exception.php";
                throw new Aomp_Exception("Undefined config section name \"resource.{$resource}\"");
            }

            if (isset(self::$_options[$resource]['classname'])) {
                $classFile  = str_replace('_', '/', self::$_options[$resource]['classname']) . '.php';
                include_once($classFile);
                $className = self::$_options[$resource]['classname'];
                $options   = self::$_options[$resource]['params'];
            } else {
                include_once(WWW_ROOT . 'library/Aomp/Application/Resource/' . ucfirst($resource) . '.php');
                $className = "Aomp_Application_Resource_" . ucfirst($resource);
                $options   = self::$_options[$resource];
            }

            $obj = new $className($options);

            if (method_exists($obj, 'init')) {
                $obj->init($options);
            }

            self::$_resources[$resource] = $obj;
        }

        return self::$_resources[$resource];
    }
}