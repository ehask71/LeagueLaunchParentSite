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
    
    public function updatePlayerHasPaid($player_id,$season_id,$site_id){
        $player = $this->find('first', array(
            'conditions' => array(
                'PlayersToSeasonsSaaS.player_id' => $player_id,
                'PlayersToSeasonsSaaS.season_id' => $season_id,
                'PlayersToSeasonsSaaS.site_id' => $site_id
            )
        ));
        if(isset($player['PlayersToSeasonsSaaS']['id'])){
            $data = array();
            $data['id'] = $player['PlayersToSeasonsSaaS']['id'];
            $data['haspaid'] = 1;
            $this->save($data);
            return true;
        }
        return false;
    }
}

