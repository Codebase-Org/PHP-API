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

$data = $role->roles();

if($data->rowCount()) {

    $roles = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $roles[] = [
            'role_id' => $row->role_id,
            'role_name' => $row->role_name,
            'created_at' => $row->created_at
        ];
    }

    echo json_encode($roles);
} else {
    echo json_encode(['message' => 'There is no roles to show']);
}