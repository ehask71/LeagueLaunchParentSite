<?php
/**
 * CakePHP OrderItemSaaS
 * @author Eric
 */
App::uses('AppModel', 'Model');

class OrderItemSaaS extends AppModel {
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'order_items';
    
}

