<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $viewClass = 'Theme';
    public $theme = 'default';
    public $helpers = array(
	'Session',
	'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
	'Form' => array('className' => 'BoostCake.BoostCakeForm'),
	'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
    );

    //public $components = array('Session');

    public function beforeFilter() {
	// $this->Session->start();
	if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
	    $this->theme = 'admin';
	}
	$this->Session->id(session_id());
        $this->set('userinfo', $this->Auth->user());
    }

    function forceSSL() {
	$redirect = '';
	if (!empty($this->params['url']['redirect'])) {
	    $redirect = '?redirect=' . $this->params['url']['redirect'];
	}

	$this->redirect('https://' . rtrim(env('SERVER_NAME'), '/') . $this->here . $redirect);
    }

}
