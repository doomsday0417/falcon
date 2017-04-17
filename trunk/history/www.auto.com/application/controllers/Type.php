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
        $this->powerAuth('write');

        if($this->_request->isPost()){


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

    }

    public function editAction()
    {
        $this->powerAuth('write');

        $typeId = ($this->getParam('typeid', 0));

        $model = new Model_Remote_Type();

        if($this->_request->isPost()){


            $typeName = $this->getParam('name');

            $type = $this->getParam('type');

            try {

                $model->editType($typeId, array('name' => $typeName, 'userid' => $this->_userId, 'type' => $type));

                $this->json(true, '修改成功');
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }
        }



        try {

            $type = $model->getType($typeId);

        }catch (Model_Exception $e){
            $this->jump('', $e->getMessage());
        }


        $this->view->assign('type', $type);

    }

}