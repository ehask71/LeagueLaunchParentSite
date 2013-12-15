<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * CakePHP ProductCategory
 * @author EricMain
 */
App::uses('Model', 'Model');

class ProductCategoryModel extends Model {
    
    public $name = 'ProductCategory';
    public $primaryKey = 'id';
    public $hasMany = array('Product');

}
