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
        mail('ehask71@gmail.com','Confirm',print_r($data,1));
        $add = array();
        $add['Registration']['shipping_address'] = $data['Registration']['billing_address'];
        $add['Registration']['shipping_address2'] = $data['Registration']['billing_address2'];
        $add['Registration']['shipping_city'] = $data['Registration']['billing_city'];
        $add['Registration']['shipping_state'] = $data['Registration']['billing_state'];
        $add['Registration']['shipping_zip'] = $data['Registration']['billing_zip'];
        $add['Registration']['shipping_country'] = $data['Registration']['billing_country'];
        
        return $data + $add;
    }
}

