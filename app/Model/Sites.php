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
        $site = $this->find('first', array(
            'conditions' => array(
                'Sites.site_id' => $id
                )));
        
        if(count($site['Sites'])>0 && count($site['Settings'])>0){
            $settings = array();
            foreach ($site['Settings'] AS $set){
                $settings[$set['name']] = $set['value'];
            }
            $site['Settings'] = $settings;
            
            return $site;
        }
        return false;
    }

}

