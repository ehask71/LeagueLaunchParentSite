<?php
/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {
    
    public $name = 'Registration';
    
    public $components = array('Session');


    public function index(){
        if(isset($this->request->query['siteid']) && $this->request->query['siteid'] != ''){
            
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
