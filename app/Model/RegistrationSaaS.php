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
        'email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your email.'
            ),
        ),
        'billing_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your billing address.'
            ),
        ),
        'billing_city' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your billing city.'
            ),
        ),
        'billing_zip' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your billing zip.'
            ),
        ),
        'billing_country' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select your billing country.'
            ),
        ),
        'billing_state' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your billing state.'
            ),
        ),
    );
}

