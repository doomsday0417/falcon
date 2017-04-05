<?php
/**
 *
 * Db in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class TypeController extends Aomp_Yaf_Controller_Abstract
{
    public $_Class = 'type';

    public $_ClassName = '类型';

    public function indexAction()
    {
        $this->powerAuth('read');

        try {
            $model = new Model_Remote_Type();

            $types = $model->getTypeAll();
        }catch (Model_Exception $e){
            echo $e->getMessage();die;
            $this->jump('', $e->getMessage());
        }

        $this->view->assign('types', $types);
    }

    public function addAction()
    {
        if($this->_request->isPost()){
            $this->powerAuth('write', 'json');

            $name = $this->getParam('name');

            $type = $this->getParam('type');

            $model = new Model_Remote_Type();

            try {
                $model->addType($this->_userId, $name, $type);
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');
        }

        $this->powerAuth('write');
    }

    public function editAction()
    {
        $typeId = ($this->getParam('typeid', 0));

        $model = new Model_Remote_Type();

        if($this->_request->isPost()){
            $this->powerAuth('write', 'json');

            $typeName = $this->getParam('name');

            $type = $this->getParam('type');

            try {

                $model->editType($typeId, array('name' => $typeName, 'userid' => $this->_userId, 'type' => $type));

                $this->json(true, '修改成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }
        }

        //权限
        $this->powerAuth('write');


        try {

            $type = $model->getType($typeId);

        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }


        $this->view->assign('type', $type);

    }

}