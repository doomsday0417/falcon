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
class Dao_Remote_Record_Db extends Aomp_Dao_Record
{
    public $dbId;

    public $userId;

    public $userName;

    public $remoteId;

    public $typeId;

    public $typeName;

    public $name;

    public $port;

    public $createTime;

    public $ip;

    public function __construct($record)
    {
        if($record){
            $this->dbId = $this->_toInt($record['dbid']);

            $this->userId = $this->_toInt($record['userid']);

            $this->userName = $this->_toString($record['username']);

            $this->remoteId = $this->_toInt($record['remoteid']);

            $this->typeId = $this->_toInt($record['typeid']);

            $this->typeName = $this->_toString($record['typename']);

            $this->name = $this->_toString($record['name']);

            $this->port = $this->_toInt($record['port']);

            $this->ip = $this->_toIp($record['ip']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}