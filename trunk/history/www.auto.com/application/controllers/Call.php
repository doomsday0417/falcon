<?php
/**
 *
 * Db in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class CallController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'call';

    public $_ClassName = '数据库';

    public function indexAction()
    {
        $this->powerAuth('read');

        $model = new Model_Call_Remote();

        $remotes = $model->getRemoteAll();

        $this->view->assign('remotes', $remotes);
    }

    public function addAction()
    {
        $this->powerAuth('write');

        //公共参数
        $type = $this->getParam('type', 'server');

        $remoteId = (int) $this->getParam('remoteid', 0);

        //POST流程
        if($this->_request->isPost()){
            $key = $this->getParam('key');
            $rule = $this->getParam('rule');
            $val = $this->getParam('val');

            //添加监控规则
            $model = new Model_Call_Remote();
            try {
                $model->addCall(array(
                    'userid' => $this->_userId,
                    'remoteid' => $remoteId,
                    'type' => $type,
                    'key' => $key,
                    'rule' => $rule,
                    'val' => $val
                ));
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }


            $this->json(true, '添加成功');
        }

        //GIT流程
        try {
            $model = new Model_Remote_Remote();

            $remote = $model->getRemote(array('remoteid' => $remoteId));

            //获取监控字段
            switch ($type) {
                case 'mysql' :
                    $model = new Model_Remote_Dba();

                    $field = $model->getDbRow();
            }

            //获取已添加的规则
            $model = new Model_Call_Call();
            $calls = $model->getCalls(array('remoteid' => $remote->remoteId, 'type' => $type));


        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }

        $this->view->assign('remote', $remote->toArray())
                   ->assign('field', $field)
                   ->assign('type', $type)
                   ->assign('calls', $calls);


    }
}