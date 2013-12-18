<?php

/**
 * CakePHP EventRegistration
 * @author EricMain
 */
App::uses('Model', 'Model');

class EventRegistration extends Model {

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

    public function storeOnePage($data, $event = array()) {
	$part = array();
	if (is_array($data['Order']['participants'])) {
	    foreach ($data['Order']['participants'] AS $p) {
		$new['name'] = $p;
		$new['email'] = $data['Order']['email'];
		$new['phone'] = $data['Order']['phone'];
		$new['address'] = $data['Order']['shipping_address'];
		$new['city'] = $data['Order']['shipping_address'];
		$new['state'] = $data['Order']['shipping_state'];
		$new['zip'] = $data['Order']['shipping_zip'];
		$new['country'] = $data['Order']['shipping_country'];
		$new['paid'] = 1;
		$new['event_id'] = $data['Order']['type_id'];
		$new['order_id'] = $data['Order']['order_id'];
		$part[] = $new;
		$this->create();
		$this->save($new);
	    }

	    if ($event['email'] != '' && $event['emailnotify'] == 'yes') {
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->cc('ehask71@gmail.com')
			->to($event['email'])
			->subject('Event Registration:' . $event['name'])
			->template('eventregister_owner')
			->theme($event['theme'])
			->emailFormat('text')
			->viewVars(array('data' => $data, 'event' => $event))
			->send();
	    }

	    return true;
	}
    }

}
