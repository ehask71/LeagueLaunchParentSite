<?php

/**
 * CakePHP Sites
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Sites extends AppModel {

    public $primaryKey = 'site_id';
    var $useDbConfig = 'SaaS';
    public $hasMany = array(
        'Settings' => array(
            'className' => 'Settings',
            'foreignKey' => 'site_id',
            'dependent' => true
        )
    );

    public function getSiteById($id) {
        
    }

}

