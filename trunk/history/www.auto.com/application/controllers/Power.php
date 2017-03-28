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
        //权限判断
        $this->powerAuth('read', $this->_Class);

        $model = new Model_Power_Power();

        $powers = $model->getPowers();

        $this->view->assign('powers', $powers->toArray());
    }

    public function addAction()
    {

        if($this->_request->isPost()){

            //权限判断
            $this->powerAuth('write', $this->_Class, 'json');

            $powerName = $this->getParam('powername');

            $powerClass = $this->getParam('powerclass');

            $sort = (int) $this->getParam('sort', 0);

            $model = new Model_Power_Power();

            try {
                $id = $model->addPower($powerName, $powerClass, $sort);
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');

        }

        $this->powerAuth('write', $this->_Class);
    }

    public function editAction()
    {
        $powerId = (int) $this->getParam('powerid', 0);

        $model = new Model_Power_Power();

        if($this->_request->isPost()){
            //权限判断
            $this->powerAuth('write', $this->_Class, 'json');

            $powerName = $this->getParam('powername');
            $powerClass = $this->getParam('powerclass');
            $sort = (int) $this->getParam('sort', 0);

            try {
                $model->editPower($powerId, array(
                    'powername' => $powerName,
                    'powerclass' => $powerClass,
                    'sort' => $sort
                ));

                $this->json(true, '修改成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }
        }

        //权限判断
        $this->powerAuth('write', $this->_Class);


        $power = $model->getPower($powerId);

        if(empty($power->powerId)){
            $this->jump('/power.html', '权限ID不存在');
        }

        $this->view->assign('power', $power->toArray());
    }

    public function deleteAction()
    {
        $this->powerAuth('delete', $this->_Class, 'json');
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