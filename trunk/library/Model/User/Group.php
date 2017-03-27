<?php
/**
 * Model_User_Group
 *
 * LICENSE
 *
 *
 * @category   Model_User_Group
 * @package    Model_Abstract
 * @copyright  $Header:  $
 * @link       $Url: $
 * @author     $Author:  $
 * @version    $Id: $
 */

class Model_User_Group extends Model_Abstract
{

    public function getGroups()
    {
        /* @var $daoGroup Dao_User_Group */
        $daoGroup = $this->getDao('Dao_User_Group');

        $groups = $daoGroup->getGroups();

        return $groups;
    }


    /**
     *
     * @param string $name
     * @param array $powers
     * @throws Model_Exception
     * @return boolean|Ambigous <boolean, string>
     */
    public function addGroup($name, array $powers)
    {
        if(empty($name)){
            throw new Model_Exception('组名不能为空');
            return false;
        }

        /* @var $daoGroup Dao_User_Group */
        $daoGroup = $this->getDao('Dao_User_Group');

        /* @var $daoGroupPower Dao_Power_GroupPower */
        $daoGroupPower = $this->getDao('Dao_Power_GroupPower');

        try {
            $id = $daoGroup->addGroup(array(
                'name' => $name
            ));

            foreach ($powers as $v){
                $v['groupid'] = $id;

                $daoGroupPower->addGroupPowers($v);
            }

        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

        return $id;
    }

    public function getGroup($groupId)
    {
        if(empty($groupId)){
            throw new Model_Exception('组ID不能为空');
        }

        /* @var $daoGroup Dao_User_Group */
        $daoGroup = $this->getDao('Dao_User_Group');

        try {
            $group = $daoGroup->getGroup(array('groupid' => $groupId));
        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return array();
        }

        return $group;
    }


}
