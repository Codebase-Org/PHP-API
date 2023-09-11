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
include_once('../../models/Login.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$login = new Login($db);

$data = json_decode(file_get_contents('php://input'));

if(isset($data)) {

    //print_r($data);
    if($login->updateOnlineStatus($data->account_id, 0)) {
        if($login->logoutHistory($data->loginID)) {
            echo json_encode(array('message' => 'You are now logged out'));
        } else {
            echo json_encode(array('message' => 'You are already logged out.'));
        }
    }

} else if(isset($_GET['loginID']) && isset($_GET['id'])) {

    if ($login->updateOnlineStatus($_GET['id'], 0)) {
        if($login->logoutHistory($_GET['loginID'])) {
            echo json_encode(array('message' => 'You are now logged out'));
        } else {
            echo json_encode(array('message' => 'You are already logged out.'));
        }
    }
}