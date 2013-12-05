<?php

/**
 * CakePHP PlayersToSeasonsSaaS
 * @author Eric
 */
App::uses('AppModel', 'Model');
App::import('Model', 'CakeSession');

class PlayersToSeasonsSaaS extends AppModel {

    public $primaryKey = 'id';
    public $useDbConfig = 'SaaS';
    public $useTable = 'players_to_seasons';

    public function updatePlayerHasPaid($player_id, $season_id, $site_id) {
	$player = $this->find('first', array(
	    'conditions' => array(
		'PlayersToSeasonsSaaS.player_id' => $player_id,
		'PlayersToSeasonsSaaS.season_id' => $season_id,
		'PlayersToSeasonsSaaS.site_id' => $site_id
	    )
	));
	if (isset($player['PlayersToSeasonsSaaS']['id'])) {
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

    public function unregisteredPlayers($players, $seasons, $site_id = FALSE) {
	if (is_array($players) && $site_id && is_array($seasons)) {
	    foreach ($seasons AS $k => $season) {
		foreach ($players AS $k => $play) {
		    if ($this->checkAlreadyRegistered($play['PlayersSaaS']['player_id'], $season['SeasonSaaS']['id'], $site_id)) {
			CakeSession::write('Registration.already_registered.'.$play['PlayersSaaS']['player_id'], $play['PlayersSaaS']['firstname'] . ' ' . $play['PlayersSaaS']['lastname']);
			unset($players[$k]);
		    }
		}
	    }
	}
	return $players;
    }

}
