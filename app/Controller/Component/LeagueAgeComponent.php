<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP LeagueAgeComponent
 * @author Eric
 */
class LeagueAgeComponent extends Component {

    public $components = array();
    public $birthdate = '';
    public $Sport = 'baseball';
    public $leagueAge = 99;
    public $divisor = array(
	'baseball' => array('formula' => '365.25', 'ageatdate' => '2014-04-30'),
	'softball' => array('formula' => '365.25', 'ageatdate' => '2013-12-31')
    );

    public function __construct(ComponentCollection $collection, $settings = array()) {
	$this->controller = $collection->getController();
	parent::__construct($collection, array_merge($this->settings, (array) $settings));
    }

    public function initialize(Controller $controller) {
	$this->Sport = Configure::read('Settings.sport');
    }

    public function startup(Controller $controller) {
	
    }

    public function calculateLeagueAge($birthdate,$leaguedate=false, $sportoverride = false) {
	$bday = (is_array($birthdate)) ? $birthdate['year'] . '-' . $birthdate['month'] . '-' . $birthdate['day'] : $birthdate;
	$sport = (!isset($this->divisor[$this->Sport])) ? 'baseball' : $this->Sport;
	if ($sportoverride) {
	    $sport = $sportoverride;
	}
        if(!$leaguedate){
            $now = $this->divisor[$sport]['ageatdate'];
        } else {
            $now = $leaguedate;
        }
	/* if (function_exists('date_diff')) {
	  $diff = date_diff(date_create($birthdate), date_create($now));
	  } else { */
	//$diff = $this->date_diff($bday, $now);
	//}
	$bday = new DateTime($bday);
	$today = new DateTime($now);
	$diff = $today->diff($bday); // This is actually not today
	$diff_days = $diff->days;
	return floor($diff_days / $this->divisor[$sport]['formula']);
    }

    public function limitAgeBasedOptions($player, $options) {
	$play = array();
        $row = array();
	$league_age = $this->calculateLeagueAge($player['birthday']);
	$useLeagueAge = $this->controller->Session->read('Registration.Settings.leagueage.use_leagueage');
	$dropdown = array('' => 'Please Select An Option');
	foreach ($options AS $opts) {
	    if ($this->controller->Session->read('Registration.leagueage.use_leagueage') == 'true') {
		if (!$error) {
		    $ages = explode(",", $opts['DivisionsSaaS']['age']);
		    if (count($ages) > 0) {
			if (in_array($league_age, $ages)) {
			    $row['registration_options'][$opts['DivisionsSaaS']['division_id']] = $opts['DivisionsSaaS']['name'] . ' ($' . $opts['ProductsSaaS']['price'] . ')';
			}
		    } else {
			$row['registration_options'][$opts['DivisionsSaaS']['division_id']] = $opts['DivisionsSaaS']['name'] . ' ($' . $opts['ProductsSaaS']['price'] . ')';
		    }
		} else {
		    if ($this->controller->Session->read('Registration.leagueage.allow_on_error') == 'true') {
			$row['registration_options'][$opts['Divisions']['division_id']] = $opts['DivisionsSaaS']['name'] . ' ($' . $opts['ProductsSaaS']['price'] . ')';
		    } else {
			$row['registration_options'][NULL] = 'Unable To Calulate Age';
		    }
		}
	    } else {
		$row['registration_options'][$opts['DivisionsSaaS']['division_id']] = $opts['DivisionsSaaS']['name'] . ' ($' . $opts['ProductsSaaS']['price'] . ')';
	    }
	}
	if (count($row['registration_options']) == 0) {
	    $row['registration_options'][NULL] = 'No Available Registrations';
	}
	$this->controller->Session->write('Registration.Players.'.$player['player_id'].'.registration_options', $row);


	return $play;
    }

    public function date_diff($date1, $date2) {

	$current = $date1;
	$datetime2 = date_create($date2);
	$count = 0;
	while (date_create($current) < $datetime2) {
	    $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
	    $count++;
	}
	return $count;
    }

}
