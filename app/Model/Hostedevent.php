<?php
/**
 * CakePHP Hostedevent
 * @author EricMain
 */
App::uses('Model', 'Model');

class Hostedevent extends Model {
    
    public $name = 'Hostedevent';
    public $useDbConfig = 'default';
    public $primaryKey = 'id';
   
    public function getHostedEventBySlug($slug){
        $evt = $this->find('first',array(
              'conditions' => array(
                'Hostedevent.slug' => $slug,
                'Hostedevent.active' => 1
              )
        ));
        
        return $evt;
    }
    
    public function transformDataOnePage($data){
        $return = array();
        $return['Order']['firstname'] = @$data['firstname'];
        $return['Order']['lastname'] = @$data['lastname'];
        $return['Order']['email'] = @$data['email'];
        $return['Order']['phone'] = @$data['phone'];
        $return['Order']['billing_address'] = @$data['address'];
        $return['Order']['billing_city'] = @$data['city'];
        $return['Order']['billing_state'] = @$data['state'];
        $return['Order']['billing_zip'] = @$data['zip'];
        $return['Order']['billing_country'] = @$data['country'];
        $return['Order']['shipping_address'] = @$data['address'];
        $return['Order']['shipping_city'] = @$data['city'];
        $return['Order']['shipping_state'] = @$data['state'];
        $return['Order']['shipping_zip'] = @$data['zip'];
        $return['Order']['shipping_country'] = @$data['country'];
        
        return $return;
    }
}
