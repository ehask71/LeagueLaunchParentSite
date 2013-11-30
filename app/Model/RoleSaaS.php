<?php
/**
 * CakePHP Role
 * @author Eric
 */
App::uses('AppModel', 'Model');

class RoleSaaS extends AppModel {
    
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'roles';
    
}

