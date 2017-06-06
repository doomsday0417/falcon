<?php

class LogController extends Aomp_Yaf_Controller_Api
{
    public function applicationAction()
    {
        //$data = $this->_request->getRequest();
        $data = $this->_request->getPost();
        $model = new Model_Log_Application();

        try {
            $model->createApplicationLog($data);
        }catch (Model_Exception $e){
            echo $e->getMessage();die;
        }

        $this->json(true, '添加成功');
    }
}