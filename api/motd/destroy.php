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
include_once('../../models/Motd.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$motd = new Motd($db);

$data = json_decode(file_get_contents('php://input'));

if(isset($data)) {

    if($motd->delete($data->motd_id)) {
        echo json_encode(array('message' => 'Message has been deleted'));
    } else {
        echo json_encode(array('message' => 'Message could not be deleted'));
    }
}