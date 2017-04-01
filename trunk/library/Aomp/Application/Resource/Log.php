<?php
/**
 * Aomp Framework
 *
 * LICENSE
 *
 *
 * @category   Aomp_Application_Resource_Log
 * @copyright  $Copyright: $
 * @author     $Author: $
 * @version    $Id:  $
 */

class Aomp_Application_Resource_Log
{

    const TYPE_NAME_DB = 'db';

    const TYPE_NAME_TEXT = 'text';

    const EMERG   = 0;  // Emergency: 系统不可用
    const ALERT   = 1;  // Alert: 严重必须立马解决的问题
    const CRIT    = 2;  // Critical: 致命错误
    const ERR     = 3;  // Error: 程序错误
    const WARN    = 4;  // Warning: 警告
    const NOTICE  = 5;  // Notice: 不导致程序异常的错误提示
    const INFO    = 6;  // Informational: 一般程序输出信息
    const DEBUG   = 7;  // Debug: debug 信息

    protected $_priorities = array(
            self::EMERG => 'emerg',
            self::ALERT => 'alert',
            self::CRIT => 'crit',
            self::ERR => 'err',
            self::WARN => 'warn',
            self::NOTICE => 'notice',
            self::INFO => 'info',
            self::DEBUG => 'debug'
    );

    public $_domain;

    public $_typeName;

    public $_path;

    /**
     *
     * @param array $options
     */
    public function init($options)
    {
        $this->_typeName = $options['typename'];
        $this->_domain = $options['domain'];
        $this->_path = isset($options['path']) ? $options['path'] : null;
    }

    public function setLog($message, $class = null, $severity = self::INFO)
    {
        //区分LOG的方式
        switch ($this->_typeName){
            case self::TYPE_NAME_DB :

                /* @var $daoLog Dao_System_Log */
                $daoLog = Aomp_Dao::factory('Dao_System_Log', 'log');

                $id = $daoLog->addLog($this->_domain, $message, $class, $severity);

                return $id;

                break 2;
            case self::TYPE_NAME_TEXT:

                $file = 'log_' . date('Ymd',time()) . '.log';

                $text = '[' . date('Y-m-d H:i:s',time()) . ']:' . $message;

                file_put_contents($this->_path . '/' . $this->_domain . '/' . $file, $text . PHP_EOL, FILE_APPEND);
        }

        return $this;

    }
}