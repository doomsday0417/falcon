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
            'isdisable' => 0
        );

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        $error = null;

        foreach ($bind as $k => $v){

            switch ($k) {
                //账号
                case 'account' :

                    if(empty($param['account'])){
                        $error = '账号不能为空';
                        break;
                    }

                    if(Aomp_Function::strLen($param['account']) > 16){
                        $error = '账号不能超过16位';
                        break;
                    }

                    //查询账号是否存在
                    $user = $daoUser->getUser(array('account' => $param['account']));

                    if(!empty($user->userId)){
                        $error = '账号存在';
                        break;
                    }

                    $bind['account'] = $param['account'];
                    break;

                //密码
                case 'password' :

                    //密码不能为空
                    if(empty($param['account'])){
                        $error = '密码不能为空';
                        break 2;
                    }

                    $config = Yaf_Application::app()->getConfig();
                    $key = $config->sites->sockey;

                    $bind['password'] = Aomp_Function::md5($param['password'], $key);
                    break;

                //组
                case 'groupid' :

                    if(empty($param['groupid'])){
                        $error = '组不存在';
                        break 2;
                    }
                    /* @var $daoGroup Dao_User_Group */
                    $daoGroup = $this->getDao('Dao_User_Group');

                    $group = $daoGroup->getGroup(array('groupid' => $param['groupid']));

                    if(empty($group->groupId)){
                        $error = '该组不存在';
                        break 2;
                    }

                    $bind['groupid'] = $group->groupId;
                    break;

                //姓名
                case 'name' :

                    if(empty($param['name'])){
                        $error = '姓名不能为空';
                        break 2;
                    }

                    $bind['name'] = $param['name'];
                    break;

                //昵称（可以空）
                case 'nick' :

                    if(empty($param['nick'])){
                        break;
                    }

                    if(Aomp_Function::strLen($param['nick']) > 20){
                        $error = '昵称不能超过20位';
                        break 2;
                    }

                    $bind['nick'] = $param['nick'];
                    break;

                //邮箱
                case 'email' :

                    if(empty($param['email'])){
                        $error = '邮箱不能为空';
                        break 2;
                    }

                    if(!Aomp_Function::isEmail($param['email'])){
                        $error = '邮箱不正确';
                        break 2;
                    }

                    $bind['email'] = $param['email'];
                    break;

                //手机
                case 'mobile' :

                    if(empty($param['mobile'])){
                        $error = '手机不能为空';
                        break 2;
                    }

                    if(!Aomp_Function::isMobile($param['mobile'])){
                        $error = '手机不正确';
                        break 2;
                    }

                    $bind['mobile'] = $param['mobile'];
                    break;
            }
        }

        //错误返回
        if(!empty($error)){
            throw new Model_Exception($error);
            return false;
        }

        try {
            $userId = $daoUser->createUser($bind);

            $this->memcache->delete('users');
            return $userId;
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }
    }

    /**
     * 获取单个管理员Model
     *
     * @param array $condition
     * @throws Model_Exception
     * @return boolean|Dao_User_Record_User
     */
    public function getUser($condition)
    {
        if(empty($condition)){
            throw new Model_Exception('条件不能为空');
            return false;
        }

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        try {
            $user = $daoUser->getUser($condition);

            if(empty($user->userId)){
                throw new Model_Exception('账号不存在');
                return false;
            }

            return $user;
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

    }

    /**
     * 获取多个管理员Model
     *
     * @param array $condition
     * @throws Model_Exception
     * @return boolean|Dao_User_Record_User
     */
    public function getUsers($condition)
    {
        if(empty($condition)){
            throw new Model_Exception('条件不能为空');
            return false;
        }

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        try {
            $users = $daoUser->getUsers($condition)->toArray();

            if(empty($users)){
                throw new Model_Exception('没有管理员');
                return false;
            }

            return $users;
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

    }

    /**
     *
     * @param array $condition
     * @param array $param
     * @throws Model_Exception
     * @return boolean
     */
    public function editUser($condition, $param)
    {
        if(empty($condition) || empty($param)){
            throw new Model_Exception('数据不能为空');
            return false;
        }

        $where = array();

        //创建数组
        $bind = array(
            'account' => '',
            'groupid' => 0,
            'password' => '',
            'name' => '',
            'nick' => '',
            'mobile' => '',
            'email' => ''
        );

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        if(isset($condition['userid']) && is_int($condition['userid'])){
            $where['userid'] = $condition['userid'];
        }

        try {
            $user = $daoUser->getUser($where);


            $error = null;

            foreach ($bind as $k => $v){

                switch ($k) {
                    //账号
                    case 'account' :

                        if(empty($param['account'])){
                            $error = '账号不能为空';
                            break;
                        }

                        if(Aomp_Function::strLen($param['account']) > 16){
                            $error = '账号不能超过16位';
                            break;
                        }

                        //查询账号是否存在
                        $user = $daoUser->getUser(array('account' => $param['account']), array('userid' => $condition['userid']));

                        if(!empty($user->userId)){
                            $error = '账号存在';
                            break;
                        }

                        $bind['account'] = $param['account'] == $user->account ? $user->account : $param['account'];
                        break;

                        //密码
                    case 'password' :

                        //允许密码为空，因为有可能不是修改密码
                        if(empty($param['password'])){
                            $bind['password'] = $user->password;
                            break;
                        }

                        $config = Yaf_Application::app()->getConfig();
                        $key = $config->sites->sockey;

                        $bind['password'] = Aomp_Function::md5($param['password'], $key) == $user->password ? $user->password : Aomp_Function::md5($param['password'], $key);

                        break;

                        //组
                    case 'groupid' :

                        if(empty($param['groupid'])){
                            $error = '组不存在';
                            break 2;
                        }

                        /* @var $daoGroup Dao_User_Group */
                        $daoGroup = $this->getDao('Dao_User_Group');

                        $group = $daoGroup->getGroup(array('groupid' => $param['groupid']));

                        if(empty($group->groupId)){
                            $error = '该组不存在';
                            break 2;
                        }

                        $bind['groupid'] = $group->groupId;
                        break;

                        //姓名
                    case 'name' :

                        if(empty($param['name'])){
                            $error = '姓名不能为空';
                            break 2;
                        }

                        $bind['name'] = $param['name'] == $user->name ? $user->name : $param['name'];
                        break;

                        //昵称（可以空）
                    case 'nick' :

                        if(empty($param['nick'])){
                            break;
                        }

                        if(Aomp_Function::strLen($param['nick']) > 20){
                            $error = '昵称不能超过20位';
                            break 2;
                        }

                        $bind['nick'] = $param['nick'] == $user->nick ? $user->nick : $param['nick'];
                        break;

                        //邮箱
                    case 'email' :

                        if(empty($param['email'])){
                            $error = '邮箱不能为空';
                            break 2;
                        }

                        if(!Aomp_Function::isEmail($param['email'])){
                            $error = '邮箱不正确';
                            break 2;
                        }

                        $bind['email'] = $param['email'] == $user->email ? $user->email : $param['email'];
                        break;

                        //手机
                    case 'mobile' :

                        if(empty($param['mobile'])){
                            $error = '手机不能为空';
                            break 2;
                        }

                        if(!Aomp_Function::isMobile($param['mobile'])){
                            $error = '手机不正确';
                            break 2;
                        }

                        $bind['mobile'] = $param['mobile'] == $user->mobile ? $user->mobile : $param['mobile'];
                        break;
                }
            }

            //错误返回
            if(!empty($error)){
                throw new Model_Exception($error);
                return false;
            }

            return $daoUser->updateUser($where, $bind);

        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

    }

    /**
     *
     * @param int $userId
     * @throws Model_Exception
     * @return boolean
     */
    public function deleteUser($userId)
    {
        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        try {
            $user = $daoUser->getUser(array('userid' => $userId));

            if(empty($user->userId)){
                throw new Model_Exception('管理员不存在');
                return false;
            }

            $row = $daoUser->deleteUser($user->userId);

            if(!$row){
                throw new Model_Exception('删除失败');
                return false;
            }

            return true;
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param int $userId
     * @param int $isDisable
     * @throws Model_Exception
     * @return boolean
     */
    public function disableUser($userId, $isDisable)
    {

        try {

            $user = $this->getUser(array('userid' => $userId));

            $daoUser = $this->getDao('Dao_User_User');

            $daoUser->updateUser(array('userid' => $user->userId), array('isdisable' => $isDisable));

            return true;
        }catch (Aomp_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }


    }


}