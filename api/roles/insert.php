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
include_once('../../models/Roles.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$role = new Roles($db);

$data = json_decode(file_get_contents('php://input'));

if(count($_POST)) {

    $params = [
        'role_name' => $_POST['role_name']
    ];

    if($role->insert($params)) {
        echo json_encode(['message' => 'Role has been added successfully']);
    } else {
        echo json_encode(['message' => 'Role has not been added, something went wrong']);
    }

} else if(isset($data)) {

    $params = [
        'role_name' => $data->role_name
    ];

    if($role->insert($params)) {
        echo json_encode(['message' => 'Role has been added successfully']);
    } else {
        echo json_encode(['message' => 'Role has not been added, something went wrong']);
    }

}