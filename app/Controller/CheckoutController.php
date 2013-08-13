<?php

/**
 * CakePHP CheckoutController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {

    public $name = 'Checkout';
    public $uses = array('Sites', 'OrderSaaS', 'PlayersToSeasonsSaaS');
    public $components = array('AuthorizeNet');

    public function beforeFilter() {
	parent::beforeFilter();
    }

    public function index() {
	
    }

    public function ll($oid = false, $sid = false) {

	$this->autoRender = false;
	if ($sid && $oid) {
	    // Here we process the LL Checkouts
	    $site = $this->Sites->getSiteById($sid);
	    if (count($site) > 0) {
		$this->Session->write('Sitedetails', $site);
		$order = $this->OrderSaaS->find('first', array(
		    'conditions' => array(
			'OrderSaaS.id' => $oid
		    )
			));
		if (count($order) > 0) {
		    // We have an order
		    if ($order['OrderSaaS']['status'] == '2') {
			$this->render('/Elements/ll_checkout_order_status_complete');
		    } else {
			$this->set(compact('sid'));
			$this->set(compact('oid'));
			$this->Session->write('Orderdetails', $order);
			$this->render('/Elements/ll_checkout_step1');
		    }
		}
	    }
	} else {
	    print_r($this->request->data);
	    $this->redirect('/');
	}
    }

    public function process() {
	if ($this->request->is('post') || $this->request->is('put')) {
	    $this->autoRender = false;
	    if ($this->request->data['Sites']['creditcard_number'] != '' && $this->request->data['Sites']['creditcard_month'] != '' && $this->request->data['Sites']['creditcard_year'] != '' && $this->request->data['Sites']['creditcard_code'] != '') {
		echo "<pre>";
		$site = $this->Session->read('Sitedetails');
		$order = $this->Session->read('Orderdetails');

		$authorizeNet = $this->AuthorizeNet->charge($order['OrderSaaS'], $this->request->data['Sites'], $site);
		if (is_string($authorizeNet)) {
		    $this->Session->setFlash($e->getMessage());
		    $this->redirect('/checkout/ll/' . $this->request->data['Sites']['oid'] . '-' . $this->request->data['Sites']['sid']);
		    mail('ehask71@gmail.com', 'Auth.Net Fail', $this->request->data['Sites']['oid']);
		    exit();
		}
		$data['id'] = $order['OrderSaaS']['id'];
		$data['authorization'] = $authorizeNet[4];
		$data['transaction'] = $authorizeNet[6];
		$data['status'] = 2;

		// Update the Order
		$this->OrderSaaS->save($data);

		foreach ($order['OrderItemSaaS'] AS $row) {
		    if ($row['player_id'] != 0 && $row['season_id'] != 0) {
			// We need to update a player
			$this->PlayersToSeasonsSaaS->updatePlayerHasPaid($row['player_id'], $row['season_id'], $this->request->data['Sites']['sid']);
		    }
		}
		$this->Session->destroy();
		//print_r($authorizeNet);
	    } else {
		$this->redirect('/checkout/ll/' . $this->request->data['Sites']['oid'] . '-' . $this->request->data['Sites']['sid']);
	    }
	}
    }

    public function testform() {
	$this->redirect('/checkout/ll/52083e28-2020-4b59-929a-7926413c2bf7-3');
    }

    public function resettest() {
	$order = $this->OrderSaaS->find('first', array(
	    'conditions' => array(
		'OrderSaaS.id' => '52083e28-2020-4b59-929a-7926413c2bf7',
		'OrderSaaS.site_id' => 3
	    )
		));

	$order['OrderSaaS']['status'] = 1;

	if ($this->OrderSaaS->save($order)) {
	    $ptos = $this->PlayersToSeasonsSaaS->find('first', array(
		'conditions' => array(
		    'PlayersToSeasonsSaaS.id' => 53
		)
		    ));

	    $ptos['PlayersToSeasonsSaaS']['haspaid'] = 0;
	    if ($this->PlayersToSeasonsSaaS->save($ptos)) {
		$this->redirect('/checkout/testform');
	    }
	} else {
	    echo 'Fail';
	}
    }

}

