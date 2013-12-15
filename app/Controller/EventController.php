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
        if ($this->request->is('post')) {
            foreach ($this->request->data['product'] AS $k => $v) {
                if ($v > 0) {
                    $this->Cart->add($k, $v, 'hosted', $this->Session->read('LLEvent.Hostedevent.id'));
                } else {
                    $this->Cart->remove($k);
                }
            }
            if ($this->Session->read('Shop.Order.order_item_count') == 0) {
                $this->Session->setFlash(__('Please Select A Product Qty!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
            } else {
                $this->Session->write('HostedEvent', $this->request->data['Hostedevent']);
                $this->Session->write('HostedEvent.participants', $this->request->data['participant']);
                $this->redirect('/event/confirm/' . $slug);
            }
        } else {
            $evt = $this->Hostedevent->getHostedEventBySlug($slug);
            if ($slug == null || count($evt) < 1) {
                $this->Session->setFlash(__('We Were Unable To Locate That Event'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
                $this->redirect('/');
            }
        }

        $this->Cart->clear();
        $this->Session->write('LLEvent', $evt);
        $this->set('slug', $slug);
        $this->theme = $evt['Hostedevent']['theme'];
        if ($this->Session->check('HostedEvent')) {
            $this->request->data = $this->Session->read('HostedEvent');
        }

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

    public function confirm($slug = null) {
        if (!$this->Session->check('LLEvent') && !$this->Session->check('Shop') && !$this->Session->check('Hostedevent')) {
            $this->Session->setFlash(__('We Were Unable To Locate That Event stage 2'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-error'
            ));
            $this->redirect('/');
        }
        /*echo '<pre>';
        print_r($this->Session->read());
        echo '<pre>';*/
        if ($this->request->is('post')) {
            
        }
        $this->theme = $this->Session->read('LLEvent.Hostedevent.theme');
        $this->set('slug', $slug);
        $this->set('event', $this->Session->read('HostedEvent'));
        $this->set('cart', $this->Session->read('Shop'));
    }

}
