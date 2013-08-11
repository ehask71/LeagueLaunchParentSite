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
        'OrderItem' => array(
            'className' => 'OrderItemSaaS',
            'foreignKey' => 'order_id',
            'dependent' => true,
        )
    );

}

