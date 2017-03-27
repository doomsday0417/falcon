<?php
/**
 * Aomp
 *
 * LICENSE
 *
 *
 * @category   Aomp
 * @package    Aomp_Dao
 * @copyright  $Copyright: $
 * @link
 * @author     $Author:  $
 * @version    $Id:  $
 */
class Dao_User_Record_User extends Aomp_Dao_Record
{
    /**
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
     * @var string
     */
    public $account;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $nick;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var unknown
     */
    public $email;

    /**
     *
     * @var string
     */
    public $mobile;

    /**
     *
     * @var boolean
     */
    public $isDisable;

    public function __construct($record = array())
    {

        if(!empty($record)){
            $this->userId = $this->_toInt($record['userid']);

            $this->groupId = $this->_toInt($record['groupid']);

            $this->account = $this->_toString($record['account']);

            $this->password = $this->_toString($record['password']);

            $this->nick = $this->_toString($record['nick']);

            $this->name = $this->_toString($record['name']);

            $this->email = $this->_toString($record['email']);

            $this->mobile = $this->_toInt($record['mobile']);

            $this->isDisable = $this->_toBoolean($record['isdisable']);
        }

        parent::__construct();
    }
}