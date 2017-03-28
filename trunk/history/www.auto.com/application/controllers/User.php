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
        $this->powerAuth('read', $this->_Class);

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
        if($this->_request->isPost()){
            //权限判断
            $this->powerAuth('write', $this->_Class);

            $account = $this->getParam('account');
            $password = $this->getParam('password');
            $name = $this->getParam('name');
            $nick = $this->getParam('nick');
            $mobile = (int) $this->getParam('mobile', 0);
            $emil = $this->getParam('email');

            $model = new Model_User_User();
        }

        //权限判断
        $this->powerAuth('write', $this->_Class);

        $groupModel = new Model_User_Group();

        $groups = $groupModel->getGroups();

        $this->view->assign('groups', $groups);
    }

    public function editAction()
    {

    }

}