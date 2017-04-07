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
class Dao_Remote_Record_Dba extends Aomp_Dao_Record
{
    public $dbaId;

    public $remoteId;

    public $ip;

    public $qps;

    public $select;

    public $insert;

    public $update;

    public $delete;

    public $innodbRowsRead;

    public $innodbRowsInserted;

    public $innodbRowsUpdated;

    public $innodbRowsDeleted;

    public $innodbLor;

    public $innodbPhr;

    public $client;

    public $conn;

    public $tmpDiskTables;

    public $tmpTables;

    public $tmpFiles;

    public $handlerDelete;

    public $handlerReadKey;

    public $handlerReadRnd;

    public $handlerUpdate;

    public $handlerWrite;

    public $innodbDataFsyncs;

    public $innodbDataReads;

    public $innodbDataWrites;

    public $tableLocksImmediate;

    public $tableLocksWait;

    public $sendTime;

    public $remarks;

    public $createTime;

    public function __construct($record)
    {
        if($record){

            $this->dbaId = $this->_toInt($record['dbaid']);
            $this->remoteId = $this->_toInt($record['remoteid']);
            $this->ip = $this->_toIp($record['ip']);
            $this->qps = $this->_toInt($record['qps']);
            $this->select = $this->_toInt($record['select']);
            $this->insert = $this->_toInt($record['insert']);
            $this->update = $this->_toInt($record['update']);
            $this->delete = $this->_toInt($record['delete']);
            $this->innodbRowsRead = $this->_toInt($record['innodbrowsread']);
            $this->innodbRowsInserted = $this->_toInt($record['innodbrowsinserted']);
            $this->innodbRowsUpdated = $this->_toInt($record['innodbrowsupdated']);
            $this->innodbRowsDeleted = $this->_toInt($record['innodbrowsdeleted']);
            $this->innodbLor = $this->_toInt($record['innodblor']);
            $this->innodbPhr = $this->_toInt($record['innodbphr']);
            $this->client = $this->_toInt($record['client']);
            $this->conn = $this->_toInt($record['conn']);
            $this->tmpDiskTables = $this->_toInt($record['tmpdisktables']);
            $this->tmpTables = $this->_toInt($record['tmptables']);
            $this->tmpFiles = $this->_toInt($record['tmpfiles']);
            $this->handlerDelete = $this->_toInt($record['handlerdelete']);
            $this->handlerReadKey = $this->_toInt($record['handlerreadkey']);
            $this->handlerReadRnd = $this->_toInt($record['handlerreadrnd']);
            $this->handlerUpdate = $this->_toInt($record['handlerupdate']);
            $this->handlerWrite = $this->_toInt($record['handlerwrite']);
            $this->innodbDataFsyncs = $this->_toInt($record['innodbdatafsyncs']);
            $this->innodbDataReads = $this->_toInt($record['innodbdatareads']);
            $this->innodbDataWrites = $this->_toInt($record['innodbdatawrites']);
            $this->tableLocksImmediate = $this->_toInt($record['tablelocksimmediate']);
            $this->tableLocksWait = $this->_toInt($record['tablelockswait']);
            $this->sendTime = $this->_toTimestamp($record['sendtime']);
            $this->remarks = $this->_toInt($record['remarks']);
            $this->createTime = $this->_toTimestamp($record['createtime']);

        }
        parent::__construct();
    }
}