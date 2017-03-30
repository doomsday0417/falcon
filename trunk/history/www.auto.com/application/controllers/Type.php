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

            $model = new Model_Remote_Type();

            try {
                $model->addType($this->_userId, $name);
            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '添加成功');
        }

        $this->powerAuth('write');
    }

}