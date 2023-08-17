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

$account_id = $_GET['id'];

if($profil->deleteProfile($account_id)) {
    if($profil->deleteAccount($account_id)) {
        echo json_encode(array('message' => 'Account has been deleted', 'status' => 'true'));
    }
} else if($profil->deleteAccount($account_id)) {
    echo json_encode(array('message' => 'Account could not be deleted', 'status' => 'true'));
} else {
    echo json_encode(array('message' => 'Account could not be deleted', 'status' => 'false'));
}