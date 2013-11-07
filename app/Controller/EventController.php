<?php

/**
 * CakePHP EventController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class EventController extends AppController {

    public $name = 'Event';
    public $uses = array('Hostedevent');
    public $components = array('Security');

    public function beforeFilter() {
	parent::beforeFilter();
	SecurityComponent::requireSecure('index','proceed');
    }

    public function index($slug = null) {
        $evt = $this->Hostedevent->getHostedEventBySlug($slug);
	if ($slug == null || count($evt) < 1) {
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
