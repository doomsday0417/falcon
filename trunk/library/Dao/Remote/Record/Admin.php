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
class Dao_Remote_Record_Admin extends Aomp_Dao_Record
{
    /**
     *
     * @var int
     */
    public $adminId;

    /**
     *
     * @var int
     */
    public $userId;

    /**
     *
     * @var int
     */
    public $remoteId;

    /**
     *
     * @var int
     */
    public $createTime;

    public function __construct($record)
    {
        if($record){
            $this->adminId = $this->_toInt($record['adminid']);

            $this->userId = $this->_toInt($record['userid']);

            $this->remoteId = $this->_toInt($record['remoteid']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}