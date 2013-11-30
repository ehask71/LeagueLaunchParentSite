<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('Sites');
    public $components = array(
        'Session',
        'Auth' => array(
            'authorize' => array('Tiny' => array(
                'aclModel' => 'RoleSaaS'
            )),
            'authenticate' => array(
                'all' => array('userModel' => 'AccountSaaS'),
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                    'scope' => array(
                        'AccountSaaS.is_active' => 'yes'
                    ),
                    'recursive' => 1,
                )),
            'loginRedirect' => array('controller' => 'registration', 'action' => 'step1'),
        ),
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'notvalid', 'login', 'register');
        if ($this->params['action'] != 'index' || $this->params['action'] != 'notvalid') {
            if (!$this->Session->check('Registration.site')) {
                $this->Session->setFlash(__('Your Session Expired!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
                $this->redirect('/registration/notvalid');
            }
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
        
    }

    public function login() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->login()) {
                
            } else {
                
            }
        }
    }

}
