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

    public function ll() {

        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['sid'] != '' && $this->request->data['oid'] != '' && $this->request->data['rtn'] != '') {
                echo "<pre>";
                // Here we process the LL Checkouts
                $site = $this->Sites->getSiteById($this->request->data['sid']);
                if (count($site) > 0) {
                    $this->Session->write('Sitedetails', $site);
                    Configure::write('Settings.llcheckout.authorize_net_api_url', $site['Settings']['authorize_net_api_url']);
                    Configure::write('Settings.llcheckout.authorize_net_login', $site['Settings']['authorize_net_login']);
                    Configure::write('Settings.llcheckout.authorize_net_txnkey', $site['Settings']['authorize_net_txnkey']);
                    print_r($site);
                    $order = $this->OrderSaaS->find('first', array(
                        'conditions' => array(
                            'OrderSaaS.id' => $this->request->data['oid']
                        )
                            ));
                    if (count($order) > 0) {
                        // We have an order
                        $this->Session->write('Orderdetails', $order);
                        print_r($order);
                        $this->render('Elements/ll_checkout_step1');
                    }
                }
            } elseif ($this->request->data['creditcard_num'] != '' && $this->request->data['creditcard_month'] != '' && $this->request->data['creditcard_year'] != '' && $this->request->data['creditcard_code'] != '') {
                $site = $this->Session->read('Sitedetails');
                $order = $this->Session->write('Orderdetails');
                Configure::write('Settings.llcheckout.authorize_net_api_url', $site['Settings']['authorize_net_api_url']);
                Configure::write('Settings.llcheckout.authorize_net_login', $site['Settings']['authorize_net_login']);
                Configure::write('Settings.llcheckout.authorize_net_txnkey', $site['Settings']['authorize_net_txnkey']);
                
                $txn = $this->
            }
        } else {
            $this->redirect('/');
        }
    }

    public function testform() {
        
    }

}

