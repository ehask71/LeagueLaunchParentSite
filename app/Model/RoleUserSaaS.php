<?php

/**
 * CakePHP RoleUser
 * @author Eric
 */
App::uses('AppModel', 'Model');

class RoleUserSaaS extends AppModel {

    public $primaryKey = 'id';
    public $useTable = 'roles_users';
    public $defaultRoleId = 6;
    public $useDbConfig = 'SaaS';

    public function addUserSite($userid,$site_id, $roleid = 0) {
        $data = array('RoleUserSaaS' => array(
                'site_id' => $site_id,
                'user_id' => (int) $userid,
                'role_id' => ($roleid != 0) ? $roleid : $this->defaultRoleId
        ));
        if ($this->save($data)) {
            return true;
        }
        return false;
    }

}
