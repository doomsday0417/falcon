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

class Dao_Power_Record_Power extends Aomp_Dao_Record
{
    /**
     *
     * @var int
     */
    public $powerId;

    /**
     *
     * @var string
     */
    public $powerName;

    /**
     *
     * @var int
     */
    public $sort;

    /**
     *
     * @var string
     */
    public $powerClass;

    /**
     *
     * @var time
     */
    public $createTime;

    public function __construct($record)
    {
        if($record){
            $this->powerId = $this->_toInt($record['powerid']);

            $this->powerName = $this->_toString($record['powername']);

            $this->powerClass = $this->_toString($record['powerclass']);

            $this->sort = $this->_toInt($record['sort']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}