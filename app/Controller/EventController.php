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

    public function index($slug = null) {
	if ($slug == null) {
	    $this->Session->setFlash(__('We Were Unable To Locate That Event'), 'alert', array(
		'plugin' => 'BoostCake',
		'class' => 'alert-error'
	    ));
	    $this->redirect('/');
	}
	$this->set('slug',$slug);
	$this->theme = 'evtbaseball1';
    }

}
