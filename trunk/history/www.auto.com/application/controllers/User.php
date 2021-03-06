<?php
/**
 *
 * Group in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class UserController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'user';

    public $_ClassName = '会员中心';

    public function indexAction()
    {
        $this->powerAuth('read');

        //用户Model
        $model = new Model_User_User();


        try{
            $users = $model->getUserAll();


        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }


        $this->view->assign('users', $users);
    }

    public function addAction()
    {
        //权限判断
        $this->powerAuth('write');

        if($this->_request->isPost()){


            $account = $this->getParam('account');
            $groupId = (int) $this->getParam('groupid');
            $password = $this->getParam('password');
            $name = $this->getParam('name');
            $nick = $this->getParam('nick');
            $mobile = (int) $this->getParam('mobile', 0);
            $email = $this->getParam('email');

            $model = new Model_User_User();

            try {
                $userId = $model->addUser(array(
                    'account' => $account,
                    'groupid' => $groupId,
                    'password' => $password,
                    'name' => $name,
                    'nick' => $nick,
                    'mobile' => $mobile,
                    'email' => $email
                ));

                $this->json(true, '添加成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

        }


        $groupModel = new Model_User_Group();

        $groups = $groupModel->getGroups();

        $this->view->assign('groups', $groups);
    }

    /**
     * 编辑
     */
    public function editAction()
    {
        $userId = (int) $this->getParam('userid');

        if($this->_request->isPost()){
            //权限判断
            $this->powerAuth('write', 'json');

            $account = $this->getParam('account');
            $groupId = (int) $this->getParam('groupid');
            $password = $this->getParam('password');
            $name = $this->getParam('name');
            $nick = $this->getParam('nick');
            $mobile = (int) $this->getParam('mobile', 0);
            $email = $this->getParam('email');

            $model = new Model_User_User();

            try {
                $userId = $model->editUser(array('userid' => $userId), array(
                    'account' => $account,
                    'groupid' => $groupId,
                    'password' => $password,
                    'name' => $name,
                    'nick' => $nick,
                    'mobile' => $mobile,
                    'email' => $email
                ));

                $this->json(true, '修改成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }
        }

        //权限判断
        $this->powerAuth('write');

        $userModel = new Model_User_User();

        try {
            $root = $userModel->getUser(array('userid' => $userId));

        }catch (Model_Exception $e){
            $this->jump('/user.html', $e->getMessage());
        }


        $groupModel = new Model_User_Group();

        $groups = $groupModel->getGroups();

        $this->view->assign('groups', $groups)
                   ->assign('root', $root->toArray());

    }

    public function deleteAction()
    {
        $this->powerAuth('delete');

        $userId = (int) $this->getParam('userid');

        $model = new Model_User_User();

        try {
            $model->deleteUser($userId);
        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }

        $this->jump('/user.html', '删除成功');
    }

    public function disableAction()
    {
        $this->powerAuth('write');

        $userId = (int) $this->getParam('userid', 0);

        $isDisable = (int) $this->getParam('disable', 0);

        $model = new Model_User_User();

        try {
            $user = $model->disableUser($userId, $isDisable);
        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }

        $this->jump('', '修改成功');
    }

    public function settingAction()
    {

        if($this->_request->isPost()){

            $password = $this->getParam('password');

            $nick = $this->getParam('nick');

            $mobile = (int) $this->getParam('mobile');

            $email = $this->getParam('email');

            $model = new Model_User_User();


            try {
                $model->editUser(array('userid' => $this->_userId), array(
                    'account' => $this->user->account,
                    'groupid' => $this->user->groupId,
                    'password' => $password,
                    'nick' => $nick,
                    'name' => $this->user->name,
                    'mobile' => $mobile,
                    'email' => $email
                ));

                $this->json(true, '修改成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

        }
    }

}