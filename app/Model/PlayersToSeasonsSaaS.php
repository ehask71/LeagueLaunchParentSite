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
    
    public function checkAlreadyRegistered($player, $id, $site_id) {
        $isreg = $this->find('first', array(
            'conditions' => array(
                'PlayersToSeasonsSaaS.site_id' => $site_id,
                'PlayersToSeasonsSaaS.player_id' => $player,
                'PlayersToSeasonsSaaS.season_id' => $id
            )
                ));
        if (count($isreg) > 0) {
            return true;
        }
        return false;
    }
}

