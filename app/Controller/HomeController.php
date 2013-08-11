<?php
App::uses('AppController', 'Controller');

class HomeController extends AppController {

    public $name = 'Home';
    
    public function beforeFilter() {
	parent::beforeFilter();
	//$this->Auth->allow('index','terms');
    }
    
    public function index(){
	//$this->Session->setFlash('Hey Rob its a Message!!','alerts/info');
    }
}

?>
