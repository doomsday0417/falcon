<?php
/**
 * Tlfun_Plugin_ViewPlugin
 *
 * LICENSE
 *
 *
 * @category   Yjgo
 * @subpackage Yjgo_Plugin_ViewPlugin
 * @copyright
 * @link
 * @author     $Author: $
 * @version    $Id: $
 */

class Aomp_Yaf_Plugin_ViewPlugin extends Yaf_Plugin_Abstract
{
    /**
     * 分发循环结束后，视图输出规则
     *
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstract $response
     */
    public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $moduleName = $request->getModuleName();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        $config     = Yaf_Application::app()->getConfig()->smarty->toArray();

        $dispatcher = Yaf_Dispatcher::getInstance();
        $view = $dispatcher->initView('');

        if ($moduleName == 'Index') {
            $dispatcher->autoRender(false);

            $scriptPath = $config['template_dir'] . $moduleName;

            $view->setScriptPath($scriptPath);

        }

        $view->assign('options', array(
                'sites'  => Yaf_Application::app()->getConfig()->sites->toArray()

        ));

        $action = str_replace('.', '-', preg_replace('/([A-Z])/', '$1', $action));

        $view->display(strtolower("{$controller}#{$action}.tpl"));
    }

    /**
     * 路由结束后加载Smarty
     * @param Yaf_Request_Abstract $request
     * @param Yaf_Response_Abstract $response
     */
    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        $modules = Yaf_Application::app()->getModules();
        $config = Yaf_Application::app()->getConfig()->smarty->toArray();

        if(count($modules) > 0){
            $config['template_dir'] .= $request->getModuleName();
        }

        $dispatcher = Yaf_Dispatcher::getInstance();
        //$dispatcher->autoRender(false);

        $smarty = new Aomp_Yaf_View_Smarty($config);
        $dispatcher->setView($smarty);

        if (isset($config['autorender']) && !$config['autorender']) {
            Yaf_Dispatcher::getInstance()->autoRender((boolean) $config['autorender']);
        }
    }
}