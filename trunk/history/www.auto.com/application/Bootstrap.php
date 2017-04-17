<?php
/**
 *
 * Bootstrap in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */

class Bootstrap extends Yaf_Bootstrap_Abstract
{
    protected $_config = null;

    //初始化错误配置
    protected function _initError()
    {
        $this->_config = Yaf_Application::app()->getConfig();

        if( isset($this->_config->application->dispatcher->displayExceptions) && !empty($this->_config->application->dispatcher->displayExceptions) ){
            ini_set('display_errors', 'On');
            error_reporting(E_ALL);
        }else{
            ini_set('display_errors', 'Off');
            error_reporting(0);
        }

        Aomp_Yaf_ResourceManager::addOptions($this->_config->resources->toArray());
    }

    //初始化插件
    protected function _initPlugin()
    {
        Yaf_Loader::import(WWW_ROOT . 'library/Aomp/Yaf/Plugin/View.php');
        $dispatcher =Yaf_Dispatcher::getInstance();

        $dispatcher->setErrorHandler(array($this, 'dispatchErrorHandler'))
                   ->registerPlugin(new Aomp_Yaf_Plugin_ViewPlugin())
                   ->registerPlugin(new Aomp_Yaf_Plugin_System())
                   ->registerPlugin(new Aomp_Yaf_Plugin_Session());
    }

    /**
     *
     * @param int    $errno
     * @param string $errstr
     * @param string $errfile
     * @param int    $errline
     */
    public function dispatchErrorHandler($errno, $errstr, $errfile, $errline)
    {
        /* @var $log Aomp_Application_Resource_Log */
        $log = Aomp_Yaf_ResourceManager::getResource('log');

        $log->setLog("Dispatch error with code:{$errno} message: {$errstr} on {$errfile} @ {$errline}");
    }

}