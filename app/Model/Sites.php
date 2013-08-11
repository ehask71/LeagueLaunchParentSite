<?php
/**
 * CakePHP Sites
 * @author Eric
 */
App::uses('AppModel', 'Model');

class Sites extends AppModel {
    public $primaryKey = 'site_id';
    var $useDbConfig = 'SaaS';
    
}

