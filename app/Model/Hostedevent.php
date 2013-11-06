<?php
/**
 * CakePHP Hostedevent
 * @author EricMain
 */
App::uses('Model', 'Model');

class Hostedevent extends Model {
    
    public $name = 'Hostedevent';
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
}
