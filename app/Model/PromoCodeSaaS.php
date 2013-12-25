<?php
/**
 * CakePHP PromoCode
 * @author EricMain
 */
App::uses('Model', 'Model');

class PromoCodeSaaS extends Model {
    
    public $name = 'PromoCode';
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
   

}
