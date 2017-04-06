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
class Dao_Remote_Record_Remote extends Aomp_Dao_Record
{
    /**
     *
     * @var int
     */
    public $remoteId;

    /**
     *
     * @var int
     */
    public $typeId;

    /**
     *
     * @var string
     */
    public $typeName;

    /**
     *
     * @var int
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $userName;

    /**
     *
     * @var int
     */
    public $ip;

    /**
     *
     * @var boolean
     */
    public $isDisable;

    /**
     *
     * @var int
     */
    public $createTime;

    public function __construct($record)
    {
        if($record){

            $this->remoteId = $this->_toInt($record['remoteid']);

            $this->typeId = $this->_toInt($record['typeid']);

            $this->typeName = $this->_toString($record['typename']);

            $this->userId = $this->_toInt($record['userid']);

            $this->name = $this->_toString($record['name']);

            $this->userName = $this->_toString($record['username']);

            $this->ip = $this->_toIp($record['ip']);

            $this->isDisable = $this->_toBoolean($record['isdisable']);

            $this->createTime = $this->_toTimestamp($record['createtime']);

        }

        parent::__construct();
    }
}