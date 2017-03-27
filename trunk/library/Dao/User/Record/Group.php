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

class Dao_User_Record_Group extends Aomp_Dao_Record
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
    public $name;

    /**
     *
     * @var time
     */
    public $createTime;

    public function __construct($record = array())
    {
        if($record){
            $this->groupId = $this->_toInt($record['groupid']);

            $this->name = $this->_toString($record['name']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}