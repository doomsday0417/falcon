<?php
/**
 *
 * Index in Yaf
 * @author $Author:  $
 * @version $Id:  $
 */
class PassportController extends Aomp_Yaf_Controller_Abstract
{

    public function indexAction()
    {
        $this->jump('/passport/login.html');
    }

    public function loginAction()
    {
        $url = $this->getParam('url', '/index.html');

        if($this->_request->isPost()){

            $account  = $this->getParam('account');

            $password = $this->getParam('password');

            try {
                $userModel = new Model_User_User();

                $user = $userModel->login($account, $password);

            }catch (Model_Exception $e){
                $this->json(false, $e->getMessage());
            }

            $this->json(true, '登陆成功', array('url' => urldecode($url)));
        }

        $this->getView()->assign('url', $url);

    }

    public function logoutAction()
    {
        $this->session->userid = 0;
echo 123;die;
        $this->jump('/passport/login.html');
    }
}