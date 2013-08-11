<?php

/**
 * CakePHP CheckoutController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {

    public $name = 'Checkout';
    public $uses = array('Settings', 'Sites');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        
    }

    public function ll($sid,$oid,$rtn) {
        $this->autoRender = false;
        //if ($this->request->is('post') || $this->request->is('put')) {
        if ($this->request->data['sid'] != '' && $this->request->data['oid'] != '' && $this->request->data['rtn'] != '') {
            // Here we process the LL Checkouts
            $site = $this->Sites->getSiteById($this->request->data['sid']);
            
            echo "<pre>";
            print_r($site);
        }
        //} else {
        //  $this->redirect('/');
        //}
    }

}

