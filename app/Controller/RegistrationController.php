<?php

/**
 * CakePHP RegistrationController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class RegistrationController extends AppController {

    public $name = 'Registration';
    public $uses = array('RegistrationSaaS','Sites', 'RoleSaaS', 'AccountSaaS', 'PlayersSaaS', 'SeasonSaaS', 'PlayersToSeasonsSaaS', 'DivisionsSaaS', 'ProductsSaaS');
    public $helpers = array('Session');
    public $components = array(
        'Session',
        'LeagueAge',
        'Saascart',
        'Auth' => array(
            'authorize' => array('Tiny' => array('aclModel' => 'RoleSaaS')),
            'authenticate' => array(
                'all' => array('userModel' => 'AccountSaaS'),
                'Form' => array(
                    'fields' => array('username' => 'email', 'password' => 'password'),
                    'scope' => array(
                        'AccountSaaS.is_active' => 'yes'
                    ),
                    'recursive' => 1,
                )),
            'flash' => array('key' => 'auth', 'element' => 'alertauth', 'params' => array()),
            'loginRedirect' => array('controller' => 'registration', 'action' => 'step1'),
            'logoutRedirect' => array('controller' => 'registration', 'action' => 'login'),
            'loginAction' => array('controller' => 'registration', 'action' => 'login'),
            'authError' => 'You must be logged in to register. <a href="/registration/register">Click Here</a> If you need an account',
        ),
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register', 'notvalid', 'index');
        $check = array('index', 'notvalid');
        if (!in_array($this->params['action'], $check)) {
            if (!$this->Session->check('Registration.site')) {
                $this->Session->setFlash(__('Your Session Expired!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
                $this->redirect('/registration/notvalid');
            }
        }

        $this->theme = (@$this->Session->read('Registration.theme') != '') ? $this->Session->read('Registration.theme') : 'regclean';
    }

    public function index() {
        $this->autoRender = false;
        if (isset($this->request->query['siteid']) && $this->request->query['siteid'] != '') {
            $theme = (isset($this->request->query['theme'])) ? $this->request->query['theme'] : 'regclean';

            $site = $this->Sites->find('first', array(
                'conditions' => array(
                    'MD5(Sites.site_id) ' => $this->request->query['siteid'],
                    'Sites.isactive' => 'yes'
                )
            ));
            if (count($site) > 0) {
                $this->Sites->buildSiteSettings($site['Settings']);
                $this->Session->write('Registration.theme', $theme);
                $this->Session->write('Registration.site', $site);
                $this->Session->write('Registration.site_id', $site['Sites']['site_id']);
                $this->redirect('/registration/step1');
            } else {
                $this->redirect('/registration/notvalid');
            }
        } elseif ($this->Session->read('Registration.site') != '') {
            $this->redirect('/registration/step1');
        } else {
            $this->redirect('/registration/notvalid');
        }
    }

    public function step1() {
        if ($this->request->is('post')) {
            // Loop Thru Players
            foreach ($this->request->data['Players'] AS $k => $v) {
                if ($v == 0) {
                    // Not Registering
                    $this->Session->delete('Registration.Players.' . $k);
                    continue;
                }
                $this->Session->write('Registration.Players.' . $k . '.season_id', $v);
                $this->Session->write('Registration.Players.' . $k . '.player_id', $k);
                $this->Session->write('Registration.Players.' . $k . '.LeagueAge', $this->SeasonSaaS->getSeasonDetails($v, 'leagueage'));
                $this->Session->write('Registration.Players.' . $k . '.name', $this->PlayersSaaS->getPlayerDetails($k, 'firstname') . ' ' . $this->PlayersSaaS->getPlayerDetails($k, 'lastname'));
                $this->Session->write('Registration.Players.' . $k . '.birthday', $this->PlayersSaaS->getPlayerDetails($k, 'birthday'));
            }
            if (is_array($this->Session->read('Registration.Players'))) {
                $this->Session->setFlash(__('Players Updated'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-info'
                ));
                $this->redirect('/registration/step2');
            } else {
                $this->Session->setFlash(__('No Leagues or Players Selected!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                ));
                $this->redirect('/registration/step1');
            }
        }
        $seasons = $this->SeasonSaaS->getOpenSeasons($this->Session->read('Registration.site_id'));
        $site_id = $this->Session->read('Registration.site_id');
        // Get Players
        if (count($seasons) > 0) {
            $players = $this->PlayersSaaS->getPlayersByUser($this->Auth->user('id'), $site_id);
            $players = $this->PlayersToSeasonsSaaS->getUnregisteredPlayers($players, $seasons, $site_id);
            $this->set(compact('seasons'));
            $this->set(compact('players'));
        } else {
            $this->Session->setFlash(__('Currently there are no open seasons for Registration. Please Check Back'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-info'
            ));
            $this->redirect('/registration/login');
        }
    }

    public function step2() {
        $players = $this->Session->read('Registration.Players');
        if (!is_array($players) || count($players) == 0) {
            $this->Session->setFlash(__('You need to Select Players & League before you can proceed'), 'alert', array(
                'plugin' => 'BoostCake',
                'class' => 'alert-error'
            ));
            $this->redirect(array('action' => 'step1'));
        }

        if ($this->request->is('post')) {
            if (count($this->request->data['Players']) > 0) {
                foreach ($this->request->data['Players'] AS $k => $v) {
                    $opts = $this->Session->read('Registration.Players.' . $k . '.registration_options');
                    $this->Saascart->add($v, 1, $k, $this->Session->read('Registration.Players.' . $k . '.season_id'));
                    $this->Session->write('Registration.Players.' . $k . '.division_id', $v);
                    $this->Session->write('Registration.Players.' . $k . '.division_name', $opts[$v]);
                }
                $this->redirect(array('action' => 'step3'));
            } else {
                $this->Session->setFlash(__('Oops! You have no Divisions selected or Eligable players'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-info'
                ));
                //$this->redirect('/registration/step2');
            }
        }
        $this->Saascart->clear();
        // Match Players with their League Assoc Products and provide a dropdown
        // Here we allow the User to pick the league the player(s) will be playing
        // in and how much they will pay 
        foreach ($players AS $play) {
            $registration_options = $this->DivisionsSaaS->getParentDivisionsProduct($this->Session->read('Registration.site_id'), $play['season_id']);
            $prepared_data = $this->LeagueAge->limitAgeBasedOptions($play, $registration_options);
            $players[$play['player_id']] = array_merge($play, $prepared_data);
        }

        $this->set(compact('players'));
    }

    public function step3() {
        $players = $this->Session->read('Registration.Players');
        $products = array();
        // Upsells and additional products
        if ($this->request->is('post')) {
            foreach ($this->request->data['Addon'] AS $k => $v) {
                $vars = explode("_", $k);
                if ($v == 'yes') {
                    $this->Saascart->add($vars[1], 2,$vars[0],$this->Session->read('Registration.Players.' . $vars[0] . '.season_id'));
                }
            }
            $this->redirect(array('action'=>'step4'));
        }
        $hasUpsell = false;
        foreach ($players AS $play) {
            $upsell = $this->SeasonSaaS->getAddons($play['season_id']);
            if ($upsell) {
                $players[$play['player_id']]['addons'] = $upsell;
                $hasUpsell = true;
            }
        }
        if (!$hasUpsell) {
            $this->redirect(array('action' => 'step4'));
        }
        $this->set(compact('players'));
    }

    public function step4() {
        $players = $this->Session->read('Registration.Players');
        $this->set(compact('players'));
        // User Details
        if($this->request->is('post')){
            $this->RegistrationSaaS->set($this->request->data);
            if($this->RegistrationSaaS->validates()){
                $shop = $this->Session->read('Shop');
                // Rock on we validated
                $data = $this->RegistrationSaaS->prepareAddress($this->request->data);
                mail('ehask71@gmail.com','Confirm',  print_r($data,1));
                $this->Session->write('Shop.Order', $shop['Order'] + $data['RegistrationSaaS']);
                $this->redirect(array('action'=>'confirm'));
            } else {
                $this->validateErrors($this->RegistrationSaaS);
                //$this->render();
            }
        }

    }

    public function step5() {
        
    }

    public function confirm() {
        $this->set('shop',$this->Session->read('Shop'));
        $this->set('registration',$this->Session->read('Registration'));
    }

    public function pay() {
        
    }

    public function notvalid() {
        $this->autoRender = false;
    }

    public function season() {
        $this->autoRender = false;
    }

    public function addplayer() {
        if ($this->request->is('post')) {

            if ($this->PlayersSaaS->validatePlayer()) {
                if ($this->PlayersSaaS->save($this->request->data)) {
                    $this->Session->setFlash(__('Player Added!'), 'alert', array(
                        'plugin' => 'BoostCake',
                        'class' => 'alert-success'
                    ));
                    $this->redirect('/registration/step1');
                }
            }
        }
        $this->set('site_id', $this->Session->read('Registration.site_id'));
        $this->set('user_id', $this->Auth->user('id'));
    }

    public function register() {
        if ($this->request->is('post')) {
            if ($this->AccountSaaS->accountValidate()) {
                if ($this->AccountSaaS->save($this->request->data)) {
                    $userid = $this->Account->getLastInsertID();
                    // Assign a Role
                    $this->loadModel('RoleUserSaaS');
                    $roleuser = $this->RoleUserSaaS->addUserSite($userid, $this->Session->read('Registration.site_id'));
                    // Log the user in
                    $role = array();
                    $role[] = array(
                        'id' => 6,
                        'alias' => 'user',
                        'RolesUser' => array(
                            'id' => $roleuser,
                            'user_id' => $userid,
                            'site_id' => $this->Session->read('Registration.site_id'),
                            'role_id' => 6
                        )
                    );
                    $this->request->data['AccountSaaS'] = array_merge($this->request->data['AccountSaaS'], array('id' => $userid, 'Role' => $role));
                    $this->Auth->login($this->request->data['AccountSaaS']);

                    $this->Session->setFlash(__('Account Created.'), 'alert', array(
                        'plugin' => 'BoostCake',
                        'class' => 'alert-success'
                    ));
                    $this->redirect('/registration/step1');
                }
            }
        }
        $this->set('site_id', $this->Session->read('Registration.site_id'));
    }

    public function login() {
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            if ($this->Auth->login()) {
                
            } else {
                
            }
        } elseif ($this->request->is('post')) {
            $this->Session->write('Auth.redirect', '');
            if ($this->Auth->login()) {
                $this->redirect(array('controller' => 'registration', 'action' => 'step1'));
            } else {
                $this->Session->setFlash(__('Invalid Login! Please Try Again!'), 'alert', array(
                    'plugin' => 'BoostCake',
                    'class' => 'alert-error'
                        ), 'auth');
            }
        }
    }

    public function logout() {
        $this->Session->write('Auth.redirect', '');
        $this->redirect($this->Auth->logout());
    }

}
