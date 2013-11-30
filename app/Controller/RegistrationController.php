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

    public function beforeFilter() {
        parent::beforeFilter();
        $this->theme = (@$this->Session->read('Registration.theme') != '')?$this->Session->read('Registration.theme'):'regclean';
    }
    
    public function index(){
        $this->autoRender = false;
        if(isset($this->request->query['siteid']) && $this->request->query['siteid'] != ''){
            $theme = (isset($this->request->query['theme']))?$this->request->query['theme']:'regclean';
            
            $site = $this->Sites->find('first', array(
                'conditions' => array(
                    'MD5(Sites.site_id) ' => $this->request->query['siteid'],
                    'Sites.isactive' => 'yes'
                )
            ));
            if(count($site) > 0){
                $this->Session->write('Registration.theme',$theme);
                $this->Session->write('Registration.site', $site);
                $this->redirect('/registration/step1');
            } else {
                $this->redirect('/registration/notvalid');
            }
        } else {
            $this->redirect('/registration/notvalid');
        }
    }
    
    public function step1(){
        $site = $this->Session->read('Registration.site');
        echo '<pre>';
        print_r($site);
        echo '</pre>';
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
