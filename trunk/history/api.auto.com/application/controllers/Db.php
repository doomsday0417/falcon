<?php

class DbController extends Aomp_Yaf_Controller_Api
{
    public function indexAction()
    {
        $data = $this->getRequest()->getRequest();

        /* @var $log Aomp_Application_Resource_Log */
        $log = Aomp_Yaf_ResourceManager::getResource('log');
        $log->setLog($data['ip']);

        $dbModel = new Model_Remote_Db();

        try {
            $dbModel->addDbData($data);
        }catch (Model_Exception $e){
            /* @var $log Aomp_Application_Resource_Log */
            $log = Aomp_Yaf_ResourceManager::getResource('log');
            $log->setLog("Dispatch error with code:{$e->getCode()} message: {$e->getMessage()} on {$e->getFile()} @ {$e->getLine()}");
        }

        $this->json(true, '接受成功');

    }
}