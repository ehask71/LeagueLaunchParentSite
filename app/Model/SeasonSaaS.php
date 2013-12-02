<?php
/**
 * CakePHP Season
 * @author Eric
 */
App::uses('AppModel', 'Model');

class SeasonSaaS extends AppModel {
    
    public $useDbConfig = 'SaaS';
    public $name = 'Season';
    public $primaryKey = 'id';
    public $useTable = 'seasons';
    
    public $hasMany = array(
        'PlayersToSeasonsSaaS' => array(
            'className' => 'PlayersToSeasonsSaaS',
	    'foreignKey' => 'season_id'
        ),
    );
    
    public function getOpenSeasons($site_id){
	Configure::write('Cake.logQuery',1);
        $seasons = $this->find('all',array(
            'conditions'=>array(
                'SeasonSaaS.site_id' => $site_id,
                'SeasonSaaS.active' => 1,
                'and' => array(
                    array('SeasonSaaS.registration_start <= ' => date('Y-m-d'),'SeasonSaaS.registration_end >= ' => date('Y-m-d'))
                )
        )));
	Configure::write('Cake.logQuery',0);
	
	return $seasons;
    }
    
    public function getActiveSeasons(){
        return $this->find('all',array(
            'conditions'=>array(
                'Season.site_id' => Configure::read('Settings.site_id'),
                'Season.active' => 1,
                'and' => array(
                    array('Season.startdate <= ' => date('Y-m-d'),'Season.enddate >= ' => date('Y-m-d'))
                )
        )));
    }
    
    public function getAccountsBySeason($season){
        
    }
     
}