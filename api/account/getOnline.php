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

$data = $account->getOnline();
$accounts = $account->accounts();

if($data->rowCount()) {
    if($accounts->rowCount()) {
        $counter = [];
        while($row = $data->fetch(PDO::FETCH_OBJ)) {
            $counter = [
                'online' => $data->rowCount(),
                'total' => $accounts->rowCount()
            ];
        }
        echo json_encode($counter);
    }

}