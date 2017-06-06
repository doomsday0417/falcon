<?php

class RemoteController extends Aomp_Yaf_Controller_Api
{
    public function monitorAction()
    {
        $data = $this->_request->getRequest();


        try {
            $model = new Model_Remote_Monitor();

            $model->addMonitor($data);
        }catch (Model_Exception $e){

            /* @var $log Aomp_Application_Resource_Log */
            $log = Aomp_Yaf_ResourceManager::getResource('log');
            $log->setLog("Dispatch error with code:{$e->getCode()} message: {$e->getMessage()} on {$e->getFile()} @ {$e->getLine()}", 6, $this->_request);

            $this->json(false, $e->getMessage());
        }

        $this->json(true, '接收成功');
    }

    public function diskAction()
    {

        $data = $this->_request->getRequest();

        try {

            $model = new Model_Remote_Disk();

            $model->addDisk($data);

        }catch (Model_Exception $e){
            /* @var $log Aomp_Application_Resource_Log */
            $log = Aomp_Yaf_ResourceManager::getResource('log');
            $log->setLog("Dispatch error with code:{$e->getCode()} message: {$e->getMessage()} on {$e->getFile()} @ {$e->getLine()}");
            $this->json(false, $e->getMessage());
        }

        $this->json(true, '接收成功');
    }
}