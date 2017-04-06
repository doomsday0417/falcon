<?php
/**
 * Aomp Dao
 *
 * 主机DAO
 *
 *
 * @category   Dao
 * @package    Dao_Remote_Dba
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */

class Dao_Remote_Dba extends Aomp_Dao_Abstract
{
    public $_table = 'remote_dba';

    /**
     * 获取数据库监控数据，由于数据量大，可以不走record
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return array|boolean
     */
    public function getDba($condition)
    {
        $where = array();
        $bind  = array();

        if(isset($condition['remoteid']) && is_int($condition['remoteid'])){
            $where[] = 'RemoteID = :remoteid';
            $bind['remoteid'] = $condition['remoteid'];
        }

        if(isset($condition['start'])){
            $where[] = 'CreateTime >= :start';
            $bind['start'] = $condition['start'];
        }

        if(isset($condition['end'])){
            $where[] = 'CreateTime <= :end';
            $bind['end'] = $condition['end'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $where = implode(' AND ', $where);

        $columns = 'ID as dbid, RemoteID AS remoteid, Ip AS ip, QPS AS qps, `Select` AS `select`, `Insert` AS `insert`, `Update` AS `update`, `Delete` AS `delete`, '
                 . 'InnodbRowsRead AS innodbrowsread, InnodbRowsInserted AS innodbrowsinserted, InnodbRowsUpdated AS innodbrowsupdated, InnodbRowsDeleted AS innodbrowsdeleted, '
                 . 'InnodbLor AS innodblor, InnodbPhr AS innodbphr, Client AS client, Conn AS conn, TmpDiskTables AS tmpdisktables, TmpTables AS tmptables, '
                 . 'TmpFiles AS tmpfiles, HandlerDelete AS handlerdelete, HandlerReadKey AS handlerreadkey, HandlerReadRnd AS handlerreadrnd, HandlerUpdate AS handlerupdate, '
                 . 'HandlerWrite AS handlerwrite, InnodbDataFsyncs AS innodbdatafsyncs, InnodbDataReads AS innodbdatareads, InnodbDataWrites AS innodbdatawrites,  '
                 . 'TableLocksImmediate AS tablelockstmmediate, TableLocksWait AS tablelockswait, SendTime AS sendtime, Remarks AS remarks, CreateTime AS createtime ';

        $sql = <<<SQL
SELECT {$columns} FROM {$this->_table} WHERE {$where}
SQL;

        try {
            $rows = $this->db->fetchAll($sql, $bind);

            return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Dba');
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }

    public function addDba($bind)
    {
        try {

            $this->db->insert($this->_table, $bind);

            return $this->db->lastInsertId();
        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}