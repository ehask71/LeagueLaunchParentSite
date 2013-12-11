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
	$this->Security->blackHoleCallback = 'forceSSL';
	$this->Security->requireSecure('index', 'confirm');
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
	$this->Session->write('LLEvent', $evt);
	$this->set('slug', $slug);
	$this->theme = $evt['Hostedevent']['theme'];
	if ($evt['Hostedevent']['products'] != '') {
	    $this->set('products', unserialize($evt['Hostedevent']['products']));
	}
    }

    public function confirm() {
	if (!$this->Session->check('LLEvent')) {
	    $this->Session->setFlash(__('We Were Unable To Locate That Event'), 'alert', array(
		'plugin' => 'BoostCake',
		'class' => 'alert-error'
	    ));
	    $this->redirect('/');
	}
    }

}
