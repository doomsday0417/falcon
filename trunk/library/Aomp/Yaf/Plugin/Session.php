<?php
/**
 * Session插件
 * Aomp_Yaf_Plugin_Session
 * @author $Author:  $
 * @version $Id:  $
 */
class Aomp_Yaf_Plugin_Session extends Yaf_Plugin_Abstract
{
    protected $_config;

    /**
     *
     * Session
     * @var array
     */
    protected $_session;

    /**
     *
     * Session 处理
     * @var Yaf_Session
     */
    protected $_sessionHandler;

    /**
     * session namespace
     */
    const SESSION_NAMESPACE = 'SESSION';

    public function __construct()
    {
        $this->_config = Yaf_Application::app()->getConfig();
    }

    /**
     * 分发循环前执行
     *
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstarct $response
     */
    public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $this->_initSession();
        $this->_initUser($request, $response);
    }

    /**
     *
     * 初始化session配置和对象
     */
    public function _initSession()
    {
        if(isset($this->_config->session)){
            $config = $this->_config->session->toArray();
            foreach ($config as $k => $v){
                switch ($k) {
                    case 'name' :
                        session_name($v);
                        break;
                    case 'save_path' :
                        session_save_path($v);
                        break;
                    case 'save_handler' :
                    case 'cookie_domain':
                    case 'cookie_path' :
                    case 'gc_maxlifetime' :
                        ini_set('session.' . $k, $v);
                }
            }

            $this->_sessionHandler = Yaf_Session::getInstance();

            try {
                $this->_sessionHandler->start();

                $this->_session = $this->_sessionHandler->get(self::SESSION_NAMESPACE);
            }catch (Exception $e){
                //写错误日志
            }

        }
    }

    /**
     *
     * 初始化用户
     *
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstarct $response
     */
    public function _initUser($request, $response)
    {
        if(!$this->_session || !$this->_session['auth']){
            return ;
        }
    }
}