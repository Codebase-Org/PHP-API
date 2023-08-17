<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
//header('Content-Type: text/html');
header('Access-Control-Allow-Methods: *');

// Including required files
include_once('../../config/Database.php');
include_once('../../config/Settings.php');
include_once('../../models/Profile.php');

$database = new Database();
$db = $database->connect();

$profil = new Profile($db);

$data = json_decode(file_get_contents('php://input'));

if(isset($data)) {

    $params = [
        'firstname' => openssl_encrypt($data->firstname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'secondname' => openssl_encrypt($data->secondname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'lastname' => openssl_encrypt($data->lastname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'worktitle' => $data->worktitle,
        'information' => $data->information,
        'account_id' => $data->account_id
    ];

    if($profil->insert($params)) {
        echo json_encode(array('message' => 'Profile has been created'));
    } else {
        echo json_encode(array('message' => 'Profile has not been created, something went wrong'));
    }
}