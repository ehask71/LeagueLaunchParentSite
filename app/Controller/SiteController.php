<?php
/**
 * CakePHP SiteController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SiteController extends AppController {
    
    public $name = 'SiteController';
    
    public function beforeFilter() {
	parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}

