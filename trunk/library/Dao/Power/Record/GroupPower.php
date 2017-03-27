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

class Dao_Power_Record_GroupPower extends Aomp_Dao_Record
{
    /**
     *
     * @var int
     */
    public $groupId;

    /**
     *
     * @var string
     */
    public $powerName;

    /**
     *
     * @var string
     */
    public $powerClass;

    /**
     *
     * @var int
     */
    public $power;

    /**
     *
     * @var time
     */
    public $createTime;

    public function __construct($record)
    {
        if($record){
            $this->groupId = $this->_toInt($record['groupid']);

            $this->powerName = $this->_toString($record['powername']);

            $this->powerClass = $this->_toString($record['powerclass']);

            $this->power = $this->_toInt($record['power']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}