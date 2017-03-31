<?php
/**
 *
 * Index in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */

class IndexController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'index';

    public $_ClassName = '服务器列表';

    public function indexAction()
    {
        $this->powerAuth('read');

        $model = new Model_Remote_Remote();

        $remotes = $model->getRemoteAll();

        $this->view->assign('remotes', $remotes);

    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $this->powerAuth('write', 'json');

            $name = $this->getParam('name');

            $ip = $this->getParam('ip');

            $typeId = (int) $this->getParam('typeid');

            $userId = $this->_userId;


            try {
                $model = new Model_Remote_Remote();

                $model->addRemote(array('typeid' => $typeId, 'name' => $name, 'userid' => $userId, 'ip' => $ip));

                $this->json(true, '添加成功');

            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
                return false;
            }
        }

        $this->powerAuth('write');

        $typeModel = new Model_Remote_Type();

        $types = $typeModel->getTypeAll();

        $this->view->assign('types', $types);
    }

    public function editAction()
    {
        $remoteId = (int) $this->getParam('remoteid', 0);

        $model = new Model_Remote_Remote();

        if($this->_request->isPost()){
            $this->powerAuth('write', 'json');

            $name = $this->getParam('name');

            $typeId = (int) $this->getParam('typeid', 0);

            $ip = $this->getParam('ip');

            try {
                $model->editRemote(array('remoteid' => $remoteId), array(
                    'name' => $name,
                    'typeid' => $typeId,
                    'ip' => $ip,
                    'userid' => $this->_userId
                ));

                $this->json(true, '修改成功');
            }catch(Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

        }

        $this->powerAuth('write');

        try {


            $remote = $model->getRemote(array('remoteid' => $remoteId));

            $typeModel = new Model_Remote_Type();

            $types = $typeModel->getTypeAll();

            $model = new Model_User_Group();

            $groups = $model->getGroups();

        }catch (Model_Exception $e){
            $this->jump('/index.html', $e->getMessage());
        }

        $this->view->assign('remote', $remote->toArray())
                   ->assign('types', $types)
                   ->assign('groups', $groups);
    }

    public function deleteAction()
    {
        $this->powerAuth('delete');

        $remoteId = (int) $this->getParam('remoteid', 0);

        $model = new Model_Remote_Remote();

        try {

            $model->deleteRemote(array('remoteid' => $remoteId));

            $this->jump('/index.html', '删除成功');

        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }
    }

    public function disableAction()
    {
        $this->powerAuth('write');

        $remoteId = (int) $this->getParam('remoteid', 0);

        $isDisable = (int) $this->getParam('disable', 0);

        try {

            $model = new Model_Remote_Remote();

            $model->disableRemote(array('remoteid' => $remoteId), $isDisable);

            $this->jump('', '修改成功');

        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }
    }
}