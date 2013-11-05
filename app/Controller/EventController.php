<?php
/**
 * CakePHP EventController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class EventController extends AppController {

    public $name = 'Event';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index(){
        
    }
    
}
