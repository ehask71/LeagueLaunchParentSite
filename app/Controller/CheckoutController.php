<?php
/**
 * CakePHP CheckoutController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {
    
    public $name = 'Checkout';
    public $uses = array('Settings','Sites');
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
    public function ll(){
        $this->autoRender = false;
        //if ($this->request->is('post') || $this->request->is('put')) {
            // Here we process the LL Checkouts
            $site = $this->Sites->find('first',array(
                'conditions' => array(
                    'Sites.site_id' => $this->request->data['sid'] = 3
                )));
            echo "<pre>";
            print_r($site);
        //} else {
          //  $this->redirect('/');
        //}
    }
}

