<?php

class AuthorizeNetComponent extends Component {

////////////////////////////////////////////////////////////

    private $url = null;
    private $api_login = null;
    private $transaction_key = null;

////////////////////////////////////////////////////////////

    public function __construct() {
        
    }

////////////////////////////////////////////////////////////

    public function initialize(Controller $controller) {

        /* $this->api_url = $this->Session->read('Sitedetails.Settings.authorize_net_api_url');
          $this->api_login = $this->Session->read('Sitedetails.Settings.authorize_net_login');
          $this->api_transaction_key = $this->Session->read('Sitedetails.Settings.authorize_net_txnkey');
         * 
         */
    }

////////////////////////////////////////////////////////////

    public function charge($data, $payment, $settings) {

        $post_values = array(
            'x_login' => $settings['Settings']['authorize_net_login'],
            'x_tran_key' => $settings['Settings']['authorize_net_txnkey'],
            'x_version' => '3.1',
            'x_delim_data' => 'TRUE',
            'x_delim_char' => ',',
            'x_encap_char' => '"',
            'x_relay_response' => 'FALSE',
            'x_type' => 'AUTH_CAPTURE',
            'x_method' => 'CC',
            'x_card_num' => $payment['creditcard_number'],
            'x_exp_date' => $payment['creditcard_month'] . $payment['creditcard_year'],
            'x_card_code' => $payment['creditcard_code'],
            'x_invoice_num' => '',
            'x_tax' => '0.00',
            'x_amount' => $data['total'],
            'x_description' => '',
            'x_first_name' => $data['first_name'],
            'x_last_name' => $data['last_name'],
            'x_address' => $data['billing_address'],
            'x_city' => $data['billing_city'],
            'x_state' => $data['billing_state'],
            'x_zip' => $data['billing_zip'],
            'x_country' => 'United States',
            'x_ship_to_first_name' => $data['first_name'],
            'x_ship_to_last_name' => $data['last_name'],
            'x_ship_to_address' => $data['billing_address'],
            'x_ship_to_city' => $data['billing_city'],
            'x_ship_to_state' => $data['billing_state'],
            'x_ship_to_zip' => $data['billing_zip'],
            'x_ship_to_country' => 'United States',
            'x_cust_id' => '',
            'x_phone' => $data['phone'],
            'x_email' => $data['email'],
            'x_customer_ip' => $_SERVER['REMOTE_ADDR'],
        );

        //debug($post_values);
        //die('end');

        App::uses('HttpSocket', 'Network/Http');
        $httpSocket = new HttpSocket();

        $response = $httpSocket->post($settings['Settings']['authorize_net_api_url'], $post_values);
        mail('ehask71@gmail.com', 'Test Auth.Net', 'Params' . $settings['Settings']['authorize_net_api_url'] . ' ' . $settings['Settings']['authorize_net_login'] . ' ' . $settings['Settings']['authorize_net_txnkey'] . ' ' . $response);
        if (!empty($response['body'])) {
            $parsed = preg_split("/,(?=(?:[^\"]*\"[^\"]*\")*(?![^\"]*\"))/", $response['body']);
            foreach ($parsed as $key => $value) {
                $parsed[$key] = substr($value, 1, -1);
            }
        } else {
            $parsed = array('-1', '-1', '-1');
        }

        if ($parsed[0] == '1') {
            return $parsed;
        } else {
            switch ($parsed[2]) {
                case '7':
                    $error = 'invalid expiration date';
                    break;

                case '8':
                    $error = 'expired';
                    break;

                case '6':
                case '17':
                case '28':
                    $error = 'declined';
                    break;

                case '78':
                    $error = 'cvc';
                    break;

                default:
                    $error = 'general';
                    break;
            }
        }

        $this->log($parsed, 'authorizenet-errors');
        return 'Credit Card Processing Errors: ' . $error;
    }

    public function chargeFromCart($data, $cart) {
        
        $post_values = array(
            'x_login' => $data['authorize_net_login'],
            'x_tran_key' => $data['authorize_net_txnkey'],
            'x_version' => '3.1',
            'x_delim_data' => 'TRUE',
            'x_delim_char' => ',',
            'x_encap_char' => '"',
            'x_relay_response' => 'FALSE',
            'x_type' => 'AUTH_CAPTURE',
            'x_method' => 'CC',
            'x_card_num' => $data['ccnum'],
            'x_exp_date' => $payment['ccmonth'] . $payment['ccyear'],
            'x_card_code' => $payment['cc_code'],
            'x_invoice_num' => '',
            'x_tax' => '0.00',
            'x_amount' => $cart['Order']['total'],
            'x_description' => '',
            'x_first_name' => $data['firstname'],
            'x_last_name' => $data['lastname'],
            'x_address' => $data['address'],
            'x_city' => $data['city'],
            'x_state' => $data['state'],
            'x_zip' => $data['zip'],
            'x_country' => $data['country'],
            'x_ship_to_first_name' => $data['firstname'],
            'x_ship_to_last_name' => $data['lastname'],
            'x_ship_to_address' => $data['address'],
            'x_ship_to_city' => $data['city'],
            'x_ship_to_state' => $data['state'],
            'x_ship_to_zip' => $data['zip'],
            'x_ship_to_country' => $data['country'],
            'x_cust_id' => '',
            'x_phone' => $data['phone'],
            'x_email' => $data['email'],
            'x_customer_ip' => $_SERVER['REMOTE_ADDR'],
        );

        App::uses('HttpSocket', 'Network/Http');
        $httpSocket = new HttpSocket();

        $response = $httpSocket->post('https://secure.authorize.net/gateway/transact.dll', $post_values);
        //mail('ehask71@gmail.com', 'Test Auth.Net', 'Params' . $settings['Settings']['authorize_net_api_url'] . ' ' . $settings['Settings']['authorize_net_login'] . ' ' . $settings['Settings']['authorize_net_txnkey'] . ' ' . $response);
        if (!empty($response['body'])) {
            $parsed = preg_split("/,(?=(?:[^\"]*\"[^\"]*\")*(?![^\"]*\"))/", $response['body']);
            foreach ($parsed as $key => $value) {
                $parsed[$key] = substr($value, 1, -1);
            }
        } else {
            $parsed = array('-1', '-1', '-1');
        }

        if ($parsed[0] == '1') {
            return $parsed;
        } else {
            switch ($parsed[2]) {
                case '7':
                    $error = 'invalid expiration date';
                    break;

                case '8':
                    $error = 'expired';
                    break;

                case '6':
                case '17':
                case '28':
                    $error = 'declined';
                    break;

                case '78':
                    $error = 'cvc';
                    break;

                default:
                    $error = 'general';
                    break;
            }
        }

        $this->log($parsed, 'authorizenet-errors');
        return 'Credit Card Processing Errors: ' . $error;
    }

////////////////////////////////////////////////////////////
}
