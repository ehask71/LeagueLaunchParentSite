<?php

/**
 * CakePHP CheckoutController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class CheckoutController extends AppController {

    public $name = 'Checkout';
    public $uses = array('Sites', 'OrderSaaS', 'PlayersToSeasonsSaaS');
    public $components = array('AuthorizeNet');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {
        
    }

    public function ll($oid = false, $sid = false, $rtn = false) {

        $this->autoRender = false;
        if ($sid && $oid && $rtn) {
            // Here we process the LL Checkouts
            $site = $this->Sites->getSiteById($sid);
            if (count($site) > 0) {
                $this->Session->write('Sitedetails', $site);
                $order = $this->OrderSaaS->find('first', array(
                    'conditions' => array(
                        'OrderSaaS.id' => $oid
                    )
                        ));
                if (count($order) > 0) {
                    // We have an order
                    if ($order['OrderSaaS']['status'] == '2') {
                        $this->render('/Elements/ll_checkout_order_status_complete');
                    } else {
                        $this->set(compact('sid'));
                        $this->set(compact('oid'));
                        $this->set(compact('rtn'));
                        $this->Session->write('Orderdetails', $order);
                        $this->render('/Elements/ll_checkout_step1');
                    }
                }
            }
        } else {
            $this->redirect('/');
        }
    }

    public function process() {
        $this->autoRender = false;
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->request->data['Sites']['creditcard_number'] != '' && $this->request->data['Sites']['creditcard_month'] != '' && $this->request->data['Sites']['creditcard_year'] != '' && $this->request->data['Sites']['creditcard_code'] != '') {
                $site = $this->Session->read('Sitedetails');
                $order = $this->Session->read('Orderdetails');

                $authorizeNet = $this->AuthorizeNet->charge($order['OrderSaaS'], $this->request->data['Sites'], $site);
                if (is_string($authorizeNet)) {
                    $this->Session->setFlash($authorizeNet);
                    $this->redirect('/checkout/ll/' . $this->request->data['Sites']['oid'] . '-' . $this->request->data['Sites']['sid'] . '-' . base64_encode($this->request->data['Sites']['rtn']));
                    exit();
                }
                $data['id'] = $order['OrderSaaS']['id'];
                $data['order_type'] = 'authnet';
                $data['authorization'] = $authorizeNet[4];
                $data['transaction'] = $authorizeNet[6];
                $data['status'] = 2;

                App::uses('CakeEmail', 'Network/Email');
                $email = new CakeEmail();
                $email->from(array('do-not-reply@leaguelaunch.com' => $site['Sites']['leaguename']))
                        ->config(array('host' => 'mail.leaguelaunch.com', 'port' => 25, 'username' => 'do-not-reply@leaguelaunch.com', 'password' => '87.~~?ZG}eI}', 'transport' => 'Smtp'))
                        ->sender($site['Settings']['admin_email'])
                        ->replyTo($site['Settings']['admin_email'])
                        ->cc($site['Settings']['admin_email'])
                        ->to($order['OrderSaaS']['email'])
                        ->subject($site['Sites']['leaguename'] . ' Payment')
                        ->template('credit_card_paid')
                        ->emailFormat('text')
                        ->theme('default')
                        ->viewVars(array('order' => $order, 'site' => $site, 'authnet' => $data))
                        ->send();

                // Update the Order
                $this->OrderSaaS->save($data);

                foreach ($order['OrderItemSaaS'] AS $row) {
                    if ($row['player_id'] != 0 && $row['season_id'] != 0) {
                        // We need to update a player
                        $players = explode(",", $row['player_id']);
                        if (is_array($players)) {
                            foreach ($players AS $player) {
                                $this->PlayersToSeasonsSaaS->updatePlayerHasPaid($player, $row['season_id'], $this->request->data['Sites']['sid']);
                            }
                        } else {
                            $this->PlayersToSeasonsSaaS->updatePlayerHasPaid($row['player_id'], $row['season_id'], $this->request->data['Sites']['sid']);
                        }
                    }
                }
                $this->Session->destroy();
                if ($this->request->data['Sites']['rtn'] != '') {
                    $this->redirect($this->request->data['Sites']['rtn']);
                } else {
                    $this->redirect(array('action' => 'success'));
                }
                //print_r($authorizeNet);
            } else {
                $this->redirect('/checkout/ll/' . $this->request->data['Sites']['oid'] . '-' . $this->request->data['Sites']['sid'] . '-' . base64_encode($this->request->data['Sites']['rtn']));
            }
        }
    }

    public function success() {
        // We redirect to here if we dont have a rtn Url
    }

    public function testform() {
        $this->redirect('/checkout/ll/52083e28-2020-4b59-929a-7926413c2bf7-3-' . base64_encode('https://leaguelaunch.com/checkout/success/'));
    }

    public function resettest() {
        $order = $this->OrderSaaS->find('first', array(
            'conditions' => array(
                'OrderSaaS.id' => '52083e28-2020-4b59-929a-7926413c2bf7',
                'OrderSaaS.site_id' => 3
            )
                ));

        $order['OrderSaaS']['status'] = 1;

        if ($this->OrderSaaS->save($order)) {
            $ptos = $this->PlayersToSeasonsSaaS->find('first', array(
                'conditions' => array(
                    'PlayersToSeasonsSaaS.id' => 53
                )
                    ));

            $ptos['PlayersToSeasonsSaaS']['haspaid'] = 0;
            if ($this->PlayersToSeasonsSaaS->save($ptos)) {
                $this->redirect('/checkout/testform');
            }
        } else {
            echo 'Fail';
        }
    }

    public function dialog() {
        $this->theme = 'dialog';
    }

    public function testiframe() {
        
    }

}

