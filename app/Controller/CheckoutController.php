<?php

/**
 * CakePHP CheckoutController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {

    public $name = 'Checkout';
    public $uses = array('Sites', 'OrderSaaS');
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
                try {
                    $authorizeNet = $this->AuthorizeNet->charge($order['OrderSaaS'], $this->request->data['Sites'], $site);
                } catch (Exception $e) {
                    $this->Session->setFlash($e->getMessage());
                    $this->redirect('/checkout/ll/' . $this->request->data['oid'] . '-' . $this->request->data['sid']);
                }
                $this->OrderSaaS->id = $order['OrderSaaS']['id'];
                $order['OrderSaaS']['authorization'] = $authorizeNet[4];
                $order['OrderSaaS']['transaction'] = $authorizeNet[6];
                $order['OrderSaaS']['status'] = 2;
                
                // Update the Order
                $this->OrderSaaS->save($order);
                
                print_r($authorizeNet);
            } else {

                $this->redirect('/checkout/ll/' . $this->request->data['oid'] . '-' . $this->request->data['sid']);
            }
        }
    }

    public function testform() {
        $this->redirect('/checkout/ll/52083e28-2020-4b59-929a-7926413c2bf7-3');
    }

}

