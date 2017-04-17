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


    /**
     * 列表
     */
    public function indexAction()
    {
        $this->powerAuth('read');

        $groupModel = new Model_User_Group();

        $groups = $groupModel->getGroups();

        $this->view->assign('group', $groups);
    }

    /**
     * 添加
     */
    public function addAction()
    {
        $this->powerAuth('write');

        //权限Model
        $powerModel = new Model_Power_Power();

        $powers = $powerModel->getPowers();

        $powers = $powers->toArray();

        //POST流程
        if($this->_request->isPost()){


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

        //GET流程

        $this->view->assign('powers', $powers);

    }

    /**
     * 编辑
     */
    public function editAction()
    {
        $this->powerAuth('write');

        $groupId = (int) $this->getParam('groupid', 0);

        //组Model
        $model = new Model_User_Group();

        //系统权限Model
        $powerModel = new Model_Power_Power();

        //组权限Model
        $groupPowerModel = new Model_Power_GroupPower();

        //获取权限列表
        $powers = $powerModel->getPowers();

        $powers = $powers->toArray();

        //POST流程
        if($this->_request->isPost()){


            $name = $this->getParam('name');

            $power = array();

            foreach ($powers as $v){

                $power[] = array(
                    'powerid' => $v['powerid'],
                    'power' => $this->getParam($v['powerclass'], 0)
                );
            }

            try {
                $model->editGroup($groupId, array('name' => $name, 'powers' => $power, 'userid' => $this->_userId));
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }


            $this->json(true, '修改成功');

        }

        //GET流程

        //根据组ID获取数据
        try {
            $group = $model->getGroup($groupId);
        }catch (Model_Exception $e){
            $this->jump('/group.html', $e->getMessage());
        }

        //获取对应已有的权限

        $groupPowesrs = $groupPowerModel->getPower($groupId);



        $this->view->assign('group', $group->toArray())
                   ->assign('powers', $powers)
                   ->assign('grouppowers', $groupPowesrs->toArray('powerclass'));
    }

    public function deleteAction()
    {
        if($this->_request->isPost()){
            $this->powerAuth('delete');

            $groupId = (int) $this->getParam('groupid');

            //组Model
            $model = new Model_User_Group();

            try {

                $model->deleteGroup($groupId);

                $this->json(true, '删除成功');

            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

        }
    }

    /**
     * 获取组管理员方法
     */
    public function getMemberAction()
    {
        if($this->_request->isPost()){
            $groupId = (int) $this->getParam('groupid', 0);

            try {
                $model = new Model_User_Group();

                $group = $model->getGroup($groupId);

                $model = new Model_User_User();

                $users = $model->getUsers(array('groupid' => $group->groupId));

                $this->json(true, '获取成功', $users);

            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }
        }
    }
}