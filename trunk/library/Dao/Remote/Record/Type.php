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

class Dao_Remote_Record_Type extends Aomp_Dao_Record
{
    /**
     *
     * @var int
     */
    public $typeId;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var int
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $userName;

    /**
     *
     * @var string
     */
    public $typeName;

    /**
     *
     * @var int
     */
    public $createTime;



    public function __construct($record)
    {
        if($record){
            $this->typeId = $this->_toInt($record['typeid']);

            $this->userId = $this->_toInt($record['userid']);

            $this->type = $this->_toString($record['type']);

            $this->userName = $this->_toString($record['username']);

            $this->typeName = $this->_toString($record['typename']);

            $this->createTime = $this->_toTimestamp($record['createtime']);
        }

        parent::__construct();
    }
}