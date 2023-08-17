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
include_once('../../models/Accounts.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$account = new Accounts($db);

$data = $account->accounts();

if($data->rowCount()) {

    //print_r($data);

    $accounts = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $accounts[$row->account_id] = [
            'id' => $row->account_id,
            'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
            'role' => $row->rolename,
            'email' => openssl_decrypt($row->email, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
            'created_date' => $row->created_date,
            'end_date' => $row->end_date
        ];
    }

    echo json_encode($accounts);
} else {
    echo json_encode(['message' => 'There are no accounts to be shown']);
}