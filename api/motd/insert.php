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

$input = json_decode(file_get_contents('php://input'));

if(count($_POST)) {

    $params = [
        'account_id' => $_POST['account_id'],
        'title' => $_POST['title'],
        'message' => $_POST['message']
    ];

    if($motd->insert($params)) {
        echo json_encode(array('message' => 'Message has be published in the system'));
    } else {
        echo json_encode(array('message' => 'Message could not be published, something went wrong'));
    }

} else if(isset($input)) {

    $params = [
        'acocunt_id' => $input->account_id,
        'title' => $input->title,
        'message' => $input->message
    ];

    if($motd->insert($params)) {
        echo json_encode(array('message' => 'Message has be published in the system'));
    } else {
        echo json_encode(array('message' => 'Message could not be published, something went wrong'));
    }
}