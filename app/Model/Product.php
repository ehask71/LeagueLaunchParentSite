<?php

/**
 * CakePHP Product
 * @author EricMain
 */
App::uses('Model', 'Model');

class Product extends Model {
    
    public $name = 'Product';
    public $primaryKey = 'id';
   
    public function getProductsByCategoryId($id){
        
        $prod = $this->find('all',array(
            'conditions' => array(
                'Product.category_id' => $id,
                'Product.visible' => 1
            )
        ));
        
        return $prod;
    } 

}
