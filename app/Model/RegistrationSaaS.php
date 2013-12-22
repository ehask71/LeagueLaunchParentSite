<?php
App::uses('AppModel', 'Model');
class RegistrationSaaS extends AppModel {
    public $useTable = false;
    
    public $validate = array(
        'first_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your first name.'
            ),
        ),
        'last_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your last name.'
            ),
        ),
    );
}

