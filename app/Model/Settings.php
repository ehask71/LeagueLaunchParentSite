<?php
/**
 * CakePHP Settings
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Settings extends AppModel {
    public $primaryKey = 'id';
    var $useDbConfig = 'SaaS';
}

