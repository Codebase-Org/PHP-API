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
include_once('../../models/Accounts.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$account = new Accounts($db);

if(isset($_GET['role_id'])) {

    $data = $account->studentCounter($_GET['role_id']);

    if($data->rowCount()) {

        $counter = $data->rowCount();
    } else {
        $counter = 0;
    }

    echo json_encode(['counter' => $counter]);
}