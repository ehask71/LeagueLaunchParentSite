<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Saascart
 * @author EricMain
 */
class SaascartComponent extends Component {

    //////////////////////////////////////////////////

    public $components = array('Session');
//////////////////////////////////////////////////

    public $controller;

//////////////////////////////////////////////////

    public function __construct(ComponentCollection $collection, $settings = array()) {
        $this->controller = $collection->getController();
        parent::__construct($collection, array_merge($this->settings, (array) $settings));
    }

//////////////////////////////////////////////////

    public function startup(Controller $controller) {
        //$this->controller = $controller;
    }

//////////////////////////////////////////////////

    public $maxQuantity = 99;

//////////////////////////////////////////////////

    public function add($id, $type = 1, $player = FALSE, $season = FALSE) {

        $quantity = 1;

        $quantity = abs($quantity);

        if ($quantity > $this->maxQuantity) {
            $quantity = $this->maxQuantity;
        }

        if ($quantity == 0) {
            $this->remove($id);
            return;
        }

        if ($type == 1) {
            $product = $this->controller->DivisionsSaaS->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'DivisionsSaaS.division_id' => $id
                )
            ));

            $name = $product['DivisionsSaaS']['name'];
            $price = $product['DivisionsSaaS']['price'];
        } else {
            $product = $this->controller->SeasonSaaS->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'SeasonSaaS.id' => $season
                )
            ));
            $addons = unserialize($product['SeasonSaaS']['addons']);
            if(!empty($addons[$id])){
                $name = $addons[$id]['name'];
                $price = $addons[$id]['price'];
            } else {
                return false;
            }
        }

        if (empty($product)) {
            return false;
        }

        $data['product_id'] = $type;
        $data['name'] = $name;
        $data['weight'] = 0.00;
        $data['price'] = sprintf('%01.2f',$price);
        $data['quantity'] = $quantity;
        $data['subtotal'] = sprintf('%01.2f', $price * $quantity);
        $data['totalweight'] = sprintf('%01.2f', 0.00 * $quantity);
        $data['player_id'] = ($player) ? $player : 0;
        $data['season_id'] = (int) ($season) ? $season : 0;
        
        $orderitems = $this->Session->read('Shop.OrderItem');
        $next = (count($orderitems)== 0)?1:(count($orderitems)+1);
      
        $this->Session->write('Shop.OrderItem.' . $next, $data);

        $this->Session->write('Shop.Order.shop', 1);

        $this->cart();

        return $product;
    }

//////////////////////////////////////////////////

    public function remove($id) {
        if ($this->Session->check('Shop.OrderItem.' . $id)) {
            $product = $this->Session->read('Shop.OrderItem.' . $id);
            $this->Session->delete('Shop.OrderItem.' . $id);

            $this->cart();
            return $product;
        }
        return false;
    }

//////////////////////////////////////////////////

    public function cart() {
        $shop = $this->Session->read('Shop');
        $quantity = 0;
        $weight = 0;
        $subtotal = 0;
        $total = 0;
        $order_item_count = 0;

        if (count($shop['OrderItem']) > 0) {
            foreach ($shop['OrderItem'] as $item) {
                $quantity += $item['quantity'];
                $weight += $item['totalweight'];
                $subtotal += $item['subtotal'];
                $total += $item['subtotal'];
                $order_item_count++;
            }
            $d['order_item_count'] = $order_item_count;
            $d['quantity'] = $quantity;
            $d['weight'] = sprintf('%01.2f', $weight);
            $d['subtotal'] = sprintf('%01.2f', $subtotal);
            $d['total'] = sprintf('%01.2f', $total);
            $this->Session->write('Shop.Order', $d + $shop['Order']);
            return true;
        } else {
            $d['quantity'] = 0;
            $d['weight'] = 0;
            $d['subtotal'] = 0;
            $d['total'] = 0;
            $this->Session->write('Shop.Order', $d + $shop['Order']);
            return false;
        }
    }

//////////////////////////////////////////////////

    public function clear() {
        $this->Session->delete('Shop');
    }

//////////////////////////////////////////////////
}
