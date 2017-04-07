<?php

class DbController extends Aomp_Yaf_Controller_Api
{
    public function indexAction()
    {
        $data = $this->_request->getRequest();


        $dbModel = new Model_Remote_Dba();

        try {
            $dbModel->addDba($data);
        }catch (Model_Exception $e){
            /* @var $log Aomp_Application_Resource_Log */
            $log = Aomp_Yaf_ResourceManager::getResource('log');
            $log->setLog("Dispatch error with code:{$e->getCode()} message: {$e->getMessage()} on {$e->getFile()} @ {$e->getLine()}");
        }

        $this->json(true, '接收成功');

    }

    public function threadAction()
    {
        $data = $this->_request->getRequest();

        $threadModel = new Model_Remote_Thread();


        try {
            $threadModel->addThread($data);

            $this->json(true, '添加成功');
        }catch (Model_Exception $e){
            $this->json(false, $e->getMessage());
        }

    }
}