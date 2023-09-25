<?php

require '..\..\firebase\JWT\JWT.php';

use \Firebase\JWT\JWT;

define('SECRET_KEY', 'ThisketIsNotforEveryOneAtAll2023');

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
//header('Content-Type: text/html');

// Including required files
include_once('../../config/Database.php');
include_once('../../config/Settings.php');
include_once('../../models/Login.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$login = new Login($db);

$input = json_decode(file_get_contents('php://input'));

if(isset($_GET['email']) && isset($_GET['password'])) {

    $params = [
        'email' => openssl_encrypt($_GET['email'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'password' => hash_hmac('sha512', $_GET['password'], PASSWORD_HASH_KEY)
    ];

    //print_r($params);

    $data = $login->login($params);

    if($data->rowCount()) {

        while($row = $data->fetch(PDO::FETCH_OBJ)) {

            if($login->updateOnlineStatus($row->account_id, 1)) {
                $login_hist_id = $login->loginHistory($row->account_id);

                $payload = [
                    'account_id' => $row->account_id,
                    'role' => $row->rolename,
                    'role_id' => $row->role_id
                ];
            }

        }

        $jwt = JWT::encode($payload, SECRET_KEY, 'HS256');
        echo json_encode(array('token' => $jwt, 'login_id' => $login_hist_id));
    } else {
        echo json_encode(array('message' => 'Username or Password could not be found'));
    }
} else if($input) {
    $params = [
        'email' => $input->email,
        'password' => $input->password
    ];
    $data = $login->login($params);

    if($data->rowCount()) {

        while($row = $data->fetch(PDO::FETCH_OBJ)) {

            $login_hist_id = $login->loginHistory($row->account_id);

            $payload = [
                'account_id' => $row->account_id,
                'role' => $row->rolename,
                'role_id' => $row->role_id
            ];

        }
        $jwt = JWT::encode($payload, SECRET_KEY, 'HS256');
        echo json_encode(array('token' => $jwt, 'login_id' => $login_hist_id));
    } else {
        echo json_encode(array('message' => 'Username or Password could not be found'));
    }
}
