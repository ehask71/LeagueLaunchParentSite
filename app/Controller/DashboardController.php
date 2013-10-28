<?php
/**
 * CakePHP DashboardController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class DashboardController extends AppController {
    
    public $name = 'Dashboard';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    // Admin
    public function admin_index(){
	
    }
    
    public function index(){
        
    }
    
}
