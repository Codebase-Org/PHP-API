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

$data = $motd->getAllMessages();

if($data->rowCount()) {

    $messages = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $name = $row->firstname . ' ' .$row->secondname. ' ' .$row->lastname;
        $messages[$row->motd_id] = [
            'motd_id' => $row->motd_id,
            'title' => $row->title,
            'message' => $row->message,
            'name' => $name
        ];
    }

    echo json_encode($messages);
} else {
    echo json_encode(array('message' => 'There is now messages to be shown'));
}