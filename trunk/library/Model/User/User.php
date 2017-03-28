<?php
/**
 * Model_User_User
 *
 * LICENSE
 *
 *
 * @category   Model_User_User
 * @package    Model_Abstract
 * @copyright  $Header:  $
 * @link       $Url: $
 * @author     $Author:  $
 * @version    $Id: $
 */

class Model_User_User extends Model_Abstract
{

    /**
     * 登陆
     *
     * @param string $account
     * @param string $password
     * @throws Model_Exception
     * @return boolean
     */
    public function login($account, $password)
    {
        if(empty($account) || empty($password)){
            throw new Model_Exception('账号密码不能为空');
        }
        $condition = array();

        if(Aomp_Function::isEmail($account)){
            $condition['email'] = $account;
        }else if(Aomp_Function::isMobile($account)){
            $condition['mobile'] = $account;
        }else{
            $condition['account'] = $account;
        }

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        $user = $daoUser->getUser($condition);

        if(empty($user->userId)){
            throw new Model_Exception('账号不存在');
            return false;
        }

        if($user->isDisable){
            throw new Model_Exception('改账号以被禁用');
            return false;
        }

        //对比密码
        $config = Yaf_Application::app()->getConfig();
        $key = $config->sites->sockey;

        if(Aomp_Function::md5($password, $key) != $user->password){
            throw new Model_Exception('密码错误');
            return false;
        }

        $cookies = array(
            $config->cookies->account => $user->account,
            $config->cookies->userid  => $user->userId
        );

        $cookieParams = session_get_cookie_params();

        foreach ($cookies as $k => $v){
            setcookie(
                $k,
                $v,
                $cookieParams['lifetime'],
                $cookieParams['path'],
                $cookieParams['domain'],
                $cookieParams['secure'],
                null
            );
        }

        $this->session->userid = $user->userId;
        $this->session->account = $user->account;


        //写登陆日志

        /* @var $daoLog Dao_User_Log */
        $daoLog = $this->getDao('Dao_User_Log');
        $daoLog->addLog($user->userId);

        return true;
    }

    /**
     * 获取全部管理员
     * @return array()
     */
    public function getUserAll()
    {
        $users = $this->memcache->get('users');

        if(1){
            /* @var $daoUser Dao_User_User */
            $daoUser = $this->getDao('Dao_User_User');

            try {
                $users = $daoUser->getUserAll()->toArray();

            }catch (Aomp_Dao_Exception $e){
                throw new Model_Exception($e->getMessage());
                return false;
            }

            $this->memcache->set('users', $users);
        }

        return $users;
    }

    public function addUser($param)
    {
        if(empty($param)){
            throw new Model_Exception('信息不能为空');
            return false;
        }

        //创建数组
        $bind = array(
            'account' => '',
            'groupid' => 0,
            'password' => '',
            'name' => '',
            'nick' => '',
            'mobile' => '',
            'email' => '',
            'isdisabled' => 0
        );

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        $error = null;

        foreach ($bind as $k => $v){
            switch ($k) {
                case 'account':
                    //查询账号是否存在
                    $user = $daoUser->getUser(array('account' => $param[$k]));

                    if(empty($param[$k])){
                        $error = '账号不能为空';
                        break 2;
                    }

                    if(empty($user->userId)){
                        $error = '账号存在';
                        break 2;
                    }

                    $bind[$k] = $param[$k];
                    break;
            }
        }
    }


}