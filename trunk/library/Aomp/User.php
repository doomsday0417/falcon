<?php

class Aomp_User
{

    /**
     * 用户ID
     *
     * @var int
     */
    public $userId;

    /**
     *
     * @var int
     */
    public $groupId;

    /**
     *
     * @var varchar
     */
    public $nick;

    /**
     *
     * @var varchar
     */
    public $name;

    /**
     *
     * @var unknown
     */
    public $isDisable;

    /**
     * 用户护照名
     *
     * @var string
     */
    public $account;

    /**
     * 用户邮箱地址
     *
     * @var string
     */
    public $email;

    /**
     * 用户手机号码
     *
     * @var string
     */
    public $mobile;

    /**
     * 用户权限
     *
     * @var array
     */
    public $power;




    /**
     * 用户属性
     *
     * @var array
     */
    private $_attributes = array();


    /**
     * Returns an instance of User
     *
     * Singleton pattern implementation
     *
     * @return Aomp_User Provides a fluent interface
     */

    public static $_instance = null;

    public function __construct()
    {
        /**
         * 清除公有的变量，保存在$_attributes中
         * 公有变量的定义主要用于定义及代码的提示
         */
        $attributes = get_object_vars($this);
        foreach ($attributes as $key => $value) {
            if ('_' != substr($key, 0, 1)) {
                $this->_attributes[$key] = $value;
                unset($this->$key);
            }
        }

        $this->init();
    }

    /**
     *
     * @return Aomp_User Provides a fluent interface
     */
    public static function getInstance()
    {
        if(null === self::$_instance){
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /**
     *
     * @return Aomp_User
     */
    public function init()
    {
        $userId = (int) $_SESSION['userid'];

        /* @var $daoUser Dao_User_User */
        $daoUser = $this->getDao('Dao_User_User');

        $memcache = new Aomp_Application_Resource_Memcache();
        $options = Yaf_Application::app()->getConfig()->resources->memcache->toArray();

        $memcache->init($options);

        $user = $memcache->get('user_' . $userId);

        if(1){
            $user = $daoUser->getUser(array('userid' => $userId));

            /* @var $daoGroupPower Dao_Power_GroupPower */
            $daoGroupPower = $this->getDao('Dao_Power_GroupPower');

            $power = $daoGroupPower->getGroupPowers(array('groupid' => $user->groupId));

            $user = $user->toArray();

            $user['power'] = $power->toArray('powerclass');
            $memcache->set('user_' . $userId, $user);
        }

        $attributes = $user;

        $this->setAttributes($attributes);
        return $this;

    }

    public function isLogined()
    {
        return $this->userId > 0;
    }

    /**
     *
     * @param array $attributes
     * @return Aomp_User
     */
    public function setAttributes(array $attributes)
    {
        foreach ($this->_attributes as $key => $value) {
            $_key = strtolower($key);
            if (isset($attributes[$_key])) {
                $this->_attributes[$key] = $attributes[$_key];
            }
        }
        return $this;
    }

    /**
     * 获取用户属性
     *
     * @return array
     */
    public function getAttributes()
    {
        return array_change_key_case($this->_attributes, CASE_LOWER);
    }

    public function getDao($className, $db = null)
    {
        return Aomp_Dao::factory($className, $db);
    }

    /**
     * 获取用户的属性，可通过 $obj->value 的方式获取
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->_attributes)) {
            return $this->_attributes[$name];
        }
        return null;
    }

    /**
     * 禁止通过此方式设置用户属性
     *
     * @param  string $name
     * @param  mixed  $value
     * @return void
     */
    public function __set($name, $value)
    {}

    /**
     * __isset()
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_attributes[$name]);
    }

    /**
     * __unset()
     *
     * @param string $name
     * @return true
     */
    public function __unset($name)
    {
        unset($this->_attributes[$name]);
    }

    /**
     * Singleton pattern implementation makes "clone" unavailable
     *
     * @return void
     */
    protected function __clone()
    {}
}