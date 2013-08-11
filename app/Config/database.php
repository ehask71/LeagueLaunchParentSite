<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => '',
		'database' => 'database_name',
		'prefix' => '',
		'encoding' => 'utf8'
	);
        
        public $SaaS = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'port' => '',
        'login' => 'demoleag_newdemo',
        'password' => '070693cory',
        'database' => 'demoleag_league',
        'schema' => '',
        'prefix' => '',
        'encoding' => ''
    );
}
