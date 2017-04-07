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
        $groups = $this->memcache->get('groups');

        if(empty($groups)){
            /* @var $daoGroup Dao_User_Group */
            $daoGroup = $this->getDao('Dao_User_Group');

            $groups = $daoGroup->getGroups()->toArray();

            $this->memcache->set('groups', $groups);
        }

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
            $group = $daoGroup->getGroup(array('name' => $name));

            if($group->groupId){
                throw new Model_Exception('改组已存在');
                return false;
            }

            $groupId = $daoGroup->addGroup(array(
                'name' => $name
            ));

            //循环添加、因为暂时DB的insert暂时不支持批量添加
            foreach ($powers as $v){
                $v['groupid'] = $groupId;

                $daoGroupPower->addGroupPowers($v);
            }

        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

        $this->memcache->delete('groups');
        return $groupId;
    }

    /**
     *
     * @param int $groupId
     * @throws Model_Exception
     * @return multitype:|Dao_User_Record_Group
     */
    public function getGroup($groupId)
    {
        if(empty($groupId)){
            throw new Model_Exception('组ID不能为空');
            return false;
        }

        /* @var $daoGroup Dao_User_Group */
        $daoGroup = $this->getDao('Dao_User_Group');

        try {
            $group = $daoGroup->getGroup(array('groupid' => $groupId));

            if(empty($group->groupId)){
                throw new Model_Exception('改组不存在');
            }

        }catch (Aomp_Dao_Exception $e){
            throw new Model_Exception($e->getMessage());
            return false;
        }

        return $group;
    }

    /**
     *
     * @param int $groupId
     * @param array $param
     * @throws Model_Exception
     * @return boolean|Ambigous <boolean, number>
     */
    public function editGroup($groupId, $param)
    {
        if(empty($groupId)){
            throw new Model_Exception('组ID不能为空');
            return false;
        }

        //$group = $this->getGroup($groupId);

        /* @var $daoGroup Dao_User_Group */
        $daoGroup = $this->getDao('Dao_User_Group');

        /* @var $daoGroupPower Dao_Power_GroupPower */
        $daoGroupPower = $this->getDao('Dao_Power_GroupPower');

        try {
            $group = $daoGroup->getGroup(array('name' => $param['name']));
            //相同名字直接返回成功
            if($group->name != $param['name']){
                $daoGroup->editGroup($groupId, array('name' => $param['name']));
            }

            //先删除该组的所有权限再添加
            $daoGroupPower->deleteGroupPowers(array('groupid' => $group->groupId));

            foreach ($param['powers'] as $v){
                $v['groupid'] = $groupId;

                $daoGroupPower->addGroupPowers($v);
            }

            /* @var $daoUser Dao_User_User */
            $daoUser = $this->getDao('Dao_User_User');

            $users = $daoUser->getUsers(array('groupid' => $group->groupId))->toArray();

            //清空改组成员所有的缓存
            if(!empty($users)){
                foreach ($users as $v){
                    $this->memcache->delete('user_' . $v['userid']);
                }
            }

            $this->memcache->delete('groups');

            return true;

        }catch (Aomp_Dao_Exception $e){

            throw new Model_Exception($e->getMessage());
            return false;
        }
    }

    /**
     *
     * @param int $groupId
     * @throws Model_Exception
     * @return boolean
     */
    public function deleteGroup($groupId)
    {
        if (empty($groupId)){
            throw new Model_Exception('ID不能为空');
            return false;
        }

        //查看组是否存在
        $group = $this->getGroup($groupId);

        if(empty($group->groupId)){
            throw new Model_Exception('该组不存在');
            return false;
        }

        try {
            //先删除权限后删除组

            /* @var $daoGroupPower Dao_Power_GroupPower */
            $daoGroupPower = $this->getDao('Dao_Power_GroupPower');

            $daoGroupPower->deleteGroupPowers(array('groupid' => $group->groupId));


            /* @var $daoGroup Dao_User_Group */
            $daoGroup = $this->getDao('Dao_User_Group');

            $daoGroup->deleteGroup(array('groupid' => $group->groupId));


            $this->memcache->delete('groups');
            return true;

        }catch (Aomp_Dao_Exception $e){
            print_r($e);die;
            throw new Model_Exception($e->getMessage());
            return false;
        }

    }


}
