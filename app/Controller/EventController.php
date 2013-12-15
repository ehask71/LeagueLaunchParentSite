<?php

/**
 * CakePHP EventController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class EventController extends AppController {

    public $name = 'Event';
    public $uses = array('Hostedevent', 'Product', 'ProductCategory', 'EventRegistration');
    public $components = array('Security', 'Cart');

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
        if ($this->request->is('post')) {
            $i = 0;
            foreach ($this->request->data['product'] AS $k => $v) {
                if ($v > 0) {
                    $this->Cart->add($k, $v, 'hosted', $this->Session->read('LLEvent.Hostedevent.id'));
                    $i++;
                } else {
                    $this->Cart->remove($k);
                    if ($i != 0) {
                        $i = $i - 1;
                    }
                }
            }
            if ($i == 0) {
                $this->Session->setFlash(__('Please Select A Product Qty!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
            } else {
                $this->autoRender = false;
                $this->Session->write('HostedEvent',$this->request->data['Hostedevent']);
                /*echo '<pre>';
                print_r($this->Session->read('Shop'));
                print_r($this->request->data);
                exit();*/
                $this->redirect(array('/event/'.$slug.'/confirm'));
            }
        }
        $this->Cart->clear();
        $this->Session->write('LLEvent', $evt);
        $this->set('slug', $slug);
        $this->theme = $evt['Hostedevent']['theme'];

        $products = $this->ProductCategory->find('all', array(
            'conditions' => array(
                'ProductCategory.type_id' => $evt['Hostedevent']['id']
            )
        ));
        //$this->set('sample',$prod);
        if ($evt['Hostedevent']['products'] != '') {
            //$this->set('products', unserialize($evt['Hostedevent']['products']));
            $this->set('products', compact('products'));
        }
    }

    public function confirm() {
        if (!$this->Session->check('LLEvent') && !$this->Session->check('Shop') && !$this->Session->check('Hostedevent')) {
            $this->Session->setFlash(__('We Were Unable To Locate That Event'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-error'
            ));
            $this->redirect('/');
        }
        if($this->request->is('post')){
            
        }
        
        $this->set('purchaser',$this->Session->read('Hostedevent'));
        $this->set('cart',$this->Session->read('Shop'));
    }

}
