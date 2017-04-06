<?php
/**
 * Aomp Dao
 *
 * 数据库服务器DAO
 *
 *
 * @category   Dao
 * @package    Dao_Remote_Db
 * @copyright  $Hearder: $
 * @author     $Author: $
 * @link       $Url: $
 * @version    $Id:  $
 */
class Dao_Remote_Db extends Aomp_Dao_Abstract
{
    private $_table = 'remote_db';

    /**
     *
     * @throws Aomp_Dao_Exception
     * @return boolean|Aomp_Dao_Recordset
     */
    public function getDbAll()
    {

        $columns = 'RD.ID AS dbid, RD.Name AS name, RD.Port AS port, RD.CreateTime AS createtime, '
                 . 'U.ID AS userid, U.Name AS username, T.ID AS typeid, T.Name AS typename, R.Ip AS ip ';

        $table = $this->_table . ' AS RD '
              . 'INNER JOIN `remote` R ON R.ID = RD.RemoteID '
              . 'INNER JOIN `type` T ON T.ID = RD.TypeID AND T.Type = "db" '
              . 'LEFT JOIN `user` U ON RD.UserID = U.ID ';

        $sql = <<<SQL
SELECT {$columns}
FROM {$table}
SQL;

        try {

            $rows = $this->db->fetchAll($sql);

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return new Aomp_Dao_Recordset($rows, 'Dao_Remote_Record_Db');
    }


    /**
     *
     * @param array $condition
     * @throws Aomp_Dao_Exception
     * @return boolean|Dao_Remote_Record_Db
     */
    public function getDb($condition)
    {
        $where = array();
        $bind  = array();

        if(isset($condition['dbid']) && is_int($condition['dbid'])){
            $where[] = 'RD.ID = :id';
            $bind['id'] = $condition['dbid'];
        }

        if(empty($where)){
            throw new Aomp_Dao_Exception('条件不能为空');
            return false;
        }

        $columns = 'RD.ID AS dbid, RD.Name AS name, RD.Port AS port, RD.CreateTime AS createtime, '
                 . 'U.ID AS userid, U.Name AS username, T.ID AS typeid, T.Name AS typename, R.Ip AS ip, R.ID AS remoteid ';

        $table = $this->_table . ' AS RD '
               . 'LEFT JOIN `remote` R ON R.ID = RD.RemoteID '
               . 'INNER JOIN `type` T ON T.ID = RD.TypeID AND T.Type = "db" '
               . 'LEFT JOIN `user` U ON RD.UserID = U.ID ';

        $where = implode(' AND ', $where);

        $sql = <<<SQL
SELECT {$columns}
FROM {$table} WHERE {$where} LIMIT 1
SQL;

        try {

            $row = $this->db->fetchRow($sql, $bind);

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }

        return Aomp_Dao::record('Dao_Remote_Record_Db', $row);
    }

    /**
     *
     * @param array $param
     * @throws Aomp_Dao_Exception
     * @return int|boolean
     */
    public function createDb($param)
    {
        try {

            $this->db->insert($this->_table, $param);

            return (int) $this->db->lastInsertId();

        }catch (Aomp_Db_Exception $e){
            throw new Aomp_Dao_Exception($e->getMessage());
            return false;
        }
    }
}