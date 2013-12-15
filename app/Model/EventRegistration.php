<?php

/**
 * CakePHP EventRegistration
 * @author EricMain
 */
App::uses('Model', 'Model');

class EventRegistrationModel extends Model {
    
    public $name = 'EventRegistration';
    public $primaryKey = 'id';
    public $validate = array(
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter your Name')
            ),
            'address' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your Address')
            ),
            'city' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your City')
            ),
            'state' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your State')
            ),
            'zip' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter your Zip/Postal Code')
            ),
            'country' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Select Your Country'
                )
            ),
            'phone' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Your Contact Number'
                )
            ),
            'email' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Your Email'
                ),
                'validEmailRule' => array(
                    'rule' => 'email',
                    'message' => 'Invalid email address'
                )
            )
    );
    
}
