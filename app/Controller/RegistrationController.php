<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('Sites','RoleSaaS');
    public $helpers = array('Session');
    public $components = array(
        'Session',
        'Auth' => array(
            'authorize' => array('Tiny' => array('aclModel' => 'RoleSaaS')),
            'authenticate' => array(
                'all' => array('userModel' => 'AccountSaaS'),
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                    'scope' => array(
                        'AccountSaaS.is_active' => 'yes'
                    ),
                    'recursive' => 1,
                )),
            'flash' => array('key' => 'auth', 'element' => 'alertauth','params' => array()),
            'loginRedirect' => array('controller' => 'registration', 'action' => 'step1'),
            'logoutRedirect' => array('controller' => 'registration', 'action' => 'login'),
            'loginAction' => array('controller' => 'registration', 'action' => 'login'),
        ),
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','logout','notvalid','index');
        if ($this->params['action'] != 'index' || $this->params['action'] != 'notvalid' || $this->params['action'] != 'login') {
           /* if (!$this->Session->check('Registration.site')) {
                $this->Session->setFlash(__('Your Session Expired!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
                $this->redirect('/registration/notvalid');
            }*/
        }
        $this->theme = (@$this->Session->read('Registration.theme') != '') ? $this->Session->read('Registration.theme') : 'regclean';
    }

    public function index() {
        $this->autoRender = false;
        if (isset($this->request->query['siteid']) && $this->request->query['siteid'] != '') {
            $theme = (isset($this->request->query['theme'])) ? $this->request->query['theme'] : 'regclean';

            $site = $this->Sites->find('first', array(
                'conditions' => array(
                    'MD5(Sites.site_id) ' => $this->request->query['siteid'],
                    'Sites.isactive' => 'yes'
                )
            ));
            if (count($site) > 0) {
                $this->Session->write('Registration.theme', $theme);
                $this->Session->write('Registration.site', $site);
                $this->redirect('/registration/step1');
            } else {
                $this->redirect('/registration/notvalid');
            }
        } else {
            $this->redirect('/registration/notvalid');
        }
    }

    public function step1() {
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

    public function notvalid() {
        $this->autoRender = false;
    }
    
    public function register(){
        if($this->request->is('post')){
            
        }
        $this->set('site_id',$this->Session->read('Registration.site.Sites.site_id'));
    } 
    
    public function login() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->login()) {
                
            } else {
                
            }
        } elseif ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect(array('controller' => 'registration', 'action' => 'step1'));
            } else {
                $this->Session->setFlash(__('Invalid Login! Please Try Again!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                        ), 'auth');
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
