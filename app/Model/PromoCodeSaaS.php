<?php
/**
 * CakePHP PromoCode
 * @author EricMain
 */
App::uses('Model', 'Model');

class PromocodeSaaS extends Model {
    
    public $name = 'Promocode';
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
   

}
