<?php
/**
 *
 * Group in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */

class GroupController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'group';

    public $_ClassName = '管理组';


    public function indexAction()
    {
        $this->powerAuth('read', $this->_Class);

        $groupModel = new Model_User_Group();

        $groups = $groupModel->getGroups();

        $this->view->assign('group', $groups->toArray());
    }

    public function addAction()
    {
        $powerModel = new Model_Power_Power();

        $powers = $powerModel->getPowers();

        $powers = $powers->toArray();

        if($this->_request->isPost()){
            $this->powerAuth('write', $this->_Class, 'json');

            $name = $this->getParam('name');

            $power = array();

            foreach ($powers as $v){

                $power[] = array(
                    'powerid' => $v['powerid'],
                    'power' => $this->getParam($v['powerclass'], 0)
                );
            }

            $groupModel = new Model_User_Group();

            try {
                $groupId = $groupModel->addGroup($name, $power);


            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');

        }

        $this->powerAuth('write', $this->_Class);



        $this->view->assign('powers', $powers);

    }

    public function editAction()
    {
        $groupId = (int) $this->getParam('groupid', 0);

        try {
            $model = new Model_User_Group();

            $group = $model->getGroup($groupId);
        }catch (Model_Exception $e){
            if($this->_request->isPost()){
                $this->json(false, $e->getMessage());
            }else{
                $this->jump('', $e->getMessage());
            }
        }

        $powerModel = new Model_Power_Power();

        $powers = $powerModel->getPowers();

        $powers = $powers->toArray();

        $groupPowerModel = new Model_Power_GroupPower();

        $groupPowerModel->getPower($groupId);

        if($this->_request->isPost()){
            $this->powerAuth('write', $this->_Class, 'json');

            $name = $this->getParam('name');
        }

        $this->powerAuth('write', $this->_Class);


        $model = new Model_User_Group();

        $group = $model->getGroup($groupId);


        $this->view->assign('group', $group->toArray())
                   ->assign('powers', $powers);
    }
}