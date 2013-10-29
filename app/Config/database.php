<?php

class DATABASE_CONFIG {

    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'leaguela_user',
        'password' => '070693Cory',
        'database' => 'leaguela_site',
        'prefix' => '',
        'encoding' => 'utf8'
    );
    // demo.leagueLaunch.com
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
