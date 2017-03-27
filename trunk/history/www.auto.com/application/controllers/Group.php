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

        if($this->_request->isPost()){
            $this->powerAuth('write', $this->_Class, 'json');

            $name = $this->getParam('name');

            $groupModel = new Model_User_Group();

            try {
                $groupModel->addGroup($name);
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');

        }

        $this->powerAuth('write', $this->_Class);

        $powerModel = new Model_Power_Power();

        $powers = $powerModel->getPowers();

        print_r($powers);die;

    }

    public function editAction()
    {
        $groupId = (int) $this->getParam('groupid', 0);

        if($this->_request->isPost()){
            $this->powerAuth('write', $this->_Class, 'json');

            $name = $this->getParam('name');
        }

        $this->powerAuth('write', $this->_Class);

        if(empty($groupId)){
            $this->jump($this->_request->getServer('HTTP_REFERER'), '管理组ID不存在');
        }

        $model = new Model_User_Group();

        $group = $model->getGroup($groupId);

        $this->view->assign('group', $group->toArray());
    }
}