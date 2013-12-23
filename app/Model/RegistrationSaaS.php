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
    
    public function prepareAddress($data){
        $add = array();
        $add['RegistrationSaaS']['shipping_address'] = $data['RegistrationSaaS']['billing_address'];
        $add['RegistrationSaaS']['shipping_address2'] = $data['RegistrationSaaS']['billing_address2'];
        $add['RegistrationSaaS']['shipping_city'] = $data['RegistrationSaaS']['billing_city'];
        $add['RegistrationSaaS']['shipping_state'] = $data['RegistrationSaaS']['billing_state'];
        $add['RegistrationSaaS']['shipping_zip'] = $data['RegistrationSaaS']['billing_zip'];
        $add['RegistrationSaaS']['shipping_country'] = $data['RegistrationSaaS']['billing_country'];
        
        return $data + $add;
    }
}

