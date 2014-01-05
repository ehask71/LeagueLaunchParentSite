<?php

/**
 * CakePHP OrderSaaS
 * @author Eric
 */
App::uses('AppModel', 'Model');

class OrderSaaS extends AppModel {

    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'orders';
    public $hasMany = array(
        'OrderItemSaaS' => array(
            'className' => 'OrderItemSaaS',
            'foreignKey' => 'order_id',
            'dependent' => true,
        )
    );
    
    public function validateCC(){
        $validate1 = array(
            'creditcard_number' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your Card Number')
            ),
            'creditcard_month' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Expiration Month')
            ),
            'creditcard_year' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the Expiration Year')
            ),
            'creditcard_code' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter the CVV Code')
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}

