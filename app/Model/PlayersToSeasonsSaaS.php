<?php
/**
 * CakePHP PlayersToSeasonsSaaS
 * @author Eric
 */
App::uses('AppModel', 'Model');

class PlayersToSeasonsSaaS extends AppModel {
    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'players_to_seasons';
    
}

