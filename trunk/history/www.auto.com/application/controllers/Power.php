<?php
/**
 *
 * Group in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */

class PowerController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'power';

    public $_ClassName = '权限';


    public function indexAction()
    {
        $this->powerAuth('read', $this->_Class);

        $model = new Model_Power_Power();

        $powers = $model->getPowers();

        $this->view->assign('powers', $powers->toArray());
    }

    public function addAction()
    {
        if($this->_request->isPost()){

            $powerName = $this->getParam('powername');

            $powerClass = $this->getParam('powerclass');

            $model = new Model_Power_Power();

            try {
                $id = $model->addPower($powerName, $powerClass);
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');

        }
    }

    public function editAction()
    {
        $powerId = (int) $this->getParam('powerid', 0);

        $model = new Model_Power_Power();
        $power = $model->getPower($powerId);

        if($this->_request->isPost()){

        }

        if(empty($power->powerId)){
            $this->jump($this->_request->getServer('HTTP_REFERER'), '权限ID不存在');
        }

        $this->view->assign('power', $power->toArray());
    }

    public function deleteAction()
    {
        $powerId = (int) $this->getParam('powerid', 0);

        $model = new Model_Power_Power();

        try {
            $power = $model->getPower($powerId);
        }catch (Model_Exception $e){
            $this->json(false, $e->getMessage());
        }


        if(empty($power->powerId)){
            $this->json(false, '权限不存在');
        }

        try {
            $res = $model->deletePower($powerId);
        }catch (Model_Exception $e){

            $this->json(false, $e->getMessage());
        }


        $this->json(true, '删除成功');
    }
}