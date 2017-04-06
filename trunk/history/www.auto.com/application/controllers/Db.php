<?php
/**
 *
 * Db in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class DbController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'db';

    public $_ClassName = '数据库';

    public function indexAction()
    {
        $this->powerAuth('read');

        $dbModel = new Model_Remote_Db();

        $dbs = $dbModel->getDbAll();

        $this->view->assign('dbs', $dbs);

    }

    public function readAction()
    {
        $this->powerAuth('read');

        $dbId = (int) $this->getParam('dbid', 0);

        $end = date('Y-m-d H:i:s', time());
        $start = date('Y-m-d H:i:s', strtotime('-1 hour'));

        $model = new Model_Remote_Db();

        try {
            $db = $model->getDb(array('dbid' => $dbId));

            $model = new Model_Remote_Dba();

            $datas = $model->getDba(array('remoteid' => $db->remoteId, 'start' => $start, 'end' => $end));

        }catch (Model_Exception $e){
            $this->jump('/db.html', $e->getMessage());
        }

        $this->view->assign('db', $db->toArray())
                   ->assign('data', $datas['data'])
                   ->assign('y', $datas['y']);

    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $this->powerAuth('write', 'json');

            //数据库名
            $name = $this->getParam('name');


            $userId = $this->_userId;

            //管理者
            $userIds = $this->_request->getPost('userid');

            //端口
            $port = (int) $this->getParam('port', 0);

            //类型ID
            $typeId = (int) $this->getParam('typeid', 0);

            //主机ID
            $remoteId = (int) $this->getParam('remoteid', 0);

            $model = new Model_Remote_Db();

            try {
                $model->addDb(array(
                    'userid' => $userId,
                    'typeid' => $typeId,
                    'remoteid' => $remoteId,
                    'name' => $name,
                    'userids' => $userIds,
                    'port' => $port
                ));
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');
        }

        $this->powerAuth('write');

        //获取数据库类型
        $model = new Model_Remote_Type();

        $types = $model->getTypes(array(
            'type' => 'db'
        ));

        //获取权限组
        $model = new Model_User_Group();

        $groups = $model->getGroups();

        //获取管理员
        $model = new Model_User_User();

        $users = $model->getUserAll();

        //获取服务器
        $model = new Model_Remote_Remote();

        $remotes = $model->getRemoteAll();

        $this->view->assign('remotes', $remotes)
                   ->assign('types', $types)
                   ->assign('groups', $groups)
                   ->assign('users', $users);
    }

}