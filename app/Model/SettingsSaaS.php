<?php
/**
 * CakePHP Settings
 * @author Eric
 */
App::uses('AppModel', 'Model');

class SettingsSaaS extends AppModel {
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'Settings';
    
}

