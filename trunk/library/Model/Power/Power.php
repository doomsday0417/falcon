<?php
/**
 * Model_User_Group
 *
 * LICENSE
 *
 *
 * @category   Model_Power_Power
 * @package    Model_Abstract
 * @copyright  $Header:  $
 * @link       $Url: $
 * @author     $Author:  $
 * @version    $Id: $
 */

class Model_Power_Power extends Model_Abstract
{
    /**
     *
     * @throws Model_Exception
     * @return Dao_Power_Record_Power
     */
    public function getPowers()
    {
        /* @var $daoPower Dao_Power_Power */
        $daoPower = $this->getDao('Dao_Power_Power');

        try {
            $powers = $daoPower->getPowerAll();
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return array();
        }

        return $powers;
    }

    /**
     *
     * @param string $powerName
     * @param string $powerClass
     * @throws Model_Exception
     * @return boolean|Ambigous <boolean, string>
     */
    public function addPower($powerName, $powerClass)
    {
        if(empty($powerClass) || empty($powerName)){
            throw new Model_Exception('数据不能为空');
            return false;
        }

        /* @var $daoPower Dao_Power_Power */
        $daoPower = $this->getDao('Dao_Power_Power');

        try {
            return $daoPower->addPower(array(
                'powername' => $powerName,
                'powerclass' => $powerClass
            ));
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param int $powerId
     * @throws Model_Exception
     * @return boolean|Dao_Power_Record_Power
     */
    public function getPower($powerId)
    {

        if(empty($powerId)){
            throw new Model_Exception('权限ID不能为空');
            return false;
        }

        /* @var $daoPower Dao_Power_Power */
        $daoPower = $this->getDao('Dao_Power_Power');

        $power = $daoPower->getPower(array(
            'powerid' => $powerId
        ));

        return $power;
    }

    public function deletePower($powerId)
    {
        if(empty($powerId)){
            throw new Model_Exception('权限ID不存在');
            return false;
        }

        /* @var $daoPower Dao_Power_Power */
        $daoPower = $this->getDao('Dao_Power_Power');

        try {
            echo 123;die;
            $daoPower->deletePower($powerId);
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }


        return true;
    }
}