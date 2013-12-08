<?php

/**
 * CakePHP Products
 * @author Eric
 */
App::uses('AppModel', 'Model');
App::import('Model', 'CakeSession');
class ProductsSaaS extends AppModel {
    
    public $useDbConfig = 'SaaS';
    public $primaryKey = 'id';

    public function getProductById($id) {
        if (($product = Cache::read('getProductById' . $id)) === false) {
            $product = $this->find('first', array('conditions' => array('Products.id' => $id, 'Products.site_id' => Configure::read('Settings.site_id'), 'Products.active' => 1)));
            Cache::write('getProductById' . $id, $product);
        }
        return $product;
    }

    public function getProductsByDivision($div, $season = FALSE) {
        return $this->query('SELECT Products . * 
                        FROM  `products` AS Products
                        INNER JOIN products_to_divisions AS ProductsToDivisions ON Products.id = ProductsToDivisions.product_id
                        WHERE ProductsToDivisions.season_id = '.$season.'
                        AND ProductsToDivisions.division_id = '.$div);
    }

    public function getUpsells($season_id) {
        $opts = array();
        $products = $this->find('all', array(
            'order' => 'ProductsSaaS.id DESC',
            'conditions' => array(
                'ProductsSaaS.site_id' => CakeSession::read('Registration.site_id'),
                'ProductsSaaS.active' => 1,
                'ProductsSaaS.category_id' => 2,
                'ProductsSaaS.season_id' => $season_id
                )));
        if (count($products) > 0) {
            foreach ($products AS $prod) {
                $opts[$prod['Products']['id']] = $prod['Products'];
            }
        }

        if (count($opts) > 0) {
            return $opts;
        }
        return FALSE;
    }

    public function getRegistrationProducts() {
        return $this->find('all', array(
                    'order' => 'Products.id DESC',
                    'conditions' => array(
                        'Products.site_id' => Configure::read('Settings.site_id'),
                        'Products.active' => 1,
                        'Products.category_id' => 1
                        )));
    }

    public function getRegistrationDropDown() {
        $products = $this->find('all', array(
            'recursive' => -1,
            'order' => 'Products.id DESC',
            'conditions' => array(
                'Products.site_id' => Configure::read('Settings.site_id'),
                'Products.active' => 1,
                'Products.category_id' => 1
            ),
            'joins' => array(
                array('table' => 'products_to_registrations', 'alias' => 'ProductsToRegistrations', 'type' => 'INNER', 'conditions' => array(
                        'Products.id = ProductsToRegistrations.product_id'
                ))
                )));
        $opts = array();
        if (count($products) > 0) {
            foreach ($products AS $prod) {
                $opts[$prod['Products']['id']] = $prod['Products']['name'] . ' ($' . $prod['Products']['price'] . ')';
            }
            return $opts;
        }
        return false;
    }

    public function validateRegProduct() {
        $validate1 = array(
            'name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Name')
            ),
            'price' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Price (9.99)')
            ),
            'description' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter a Description')
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function getProductsByCat($id,$select=false){
        $data = $this->find('all',array(
            'conditions' => array(
                'Products.category_id' => $id,
                'Products.site_id' => Configure::read('Settings.site_id')
            )
        ));
        
        if($select){
            if(is_array($data)){
                $return = array();
                foreach($data AS $row){
                    $return[$row['Products']['id']] = '$'.$row['Products']['price'].' '.$row['Products']['name'];
                }
                return $return;
            }
        }
        return $data;
    } 
    
    /*public function getProductById($id){
        $data = $this->find('first',array(
            'conditions' => array(
                'Products.id' => $id,
                'Products.site_id' => Configure::read('Settings.site_id')
            )
        ));
        
        return $data;
    }*/

}

