<?php
/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {
    
    public $name = 'Registration';
    public $uses = array('Sites');
    public $components = array('Session');


    public function index(){
        $this->autoRender = false;
        if(isset($this->request->query['siteid']) && $this->request->query['siteid'] != ''){
            $site = $this->Sites->find('first', array(
                'conditions' => array(
                    'MD5(Sites.id) ' => $this->request->query['siteid']
                )
            ));
            echo '<pre>';
            print_r($site);
            echo '</pre>';
        } else {
            $this->redirect('/registration/notvalid');
        }
    }
    
    public function step1(){
	
    }
    
    public function step2() {
	
    }
    
    public function step3() {
	
    }
    
    public function step4() {
	
    }
    
    public function step5() {
	
    }
    
    public function confirm() {
	
    }
    
    public function pay() {
	
    }
    
    public function notvalid(){
        
    }
    
}
