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
            'className' => 'SettingsSaaS',
            'foreignKey' => 'site_id',
            'dependent' => true
        )
    );

    public function getSiteById($id) {
        $site = $this->find('first', array(
            'conditions' => array(
                'Sites.site_id' => $id
                )));
        
        if(count($site)>0){
            $settings = array();
            foreach ($site['Settings'] AS $set){
                $settings[$set['name']] = $set['value'];
            }
            $site['Settings'] = $settings;
            
            return $site;
        }
        return false;
    }
    
    function buildSiteSettings($setarray){
	$settings = array();
	if (count($setarray) > 0) {
	    foreach ($setarray as $row) {
		if ($row['type'] == 'object' || $row['type'] == 'array') {
		    // Handle Arrays and Objects
		    $settings[$row['name']] = unserialize($row['value']);
		} else {
		    // Default is string
		    $settings[$row['name']] = (string) $row['value'];
		}
	    }
	}
    }

}

