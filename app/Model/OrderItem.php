<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * CakePHP OrderItem
 * @author EricMain
 */
App::uses('Model', 'Model');

class OrderItem extends Model {

    public $name = 'OrderItem';
    public $primaryKey = 'id';
    public $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true,
            'counterScope' => array(),
        )
    );

}
