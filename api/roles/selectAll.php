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

if(isset($_GET['role_id'])) {
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
        if($_GET['role_id'] == 1) {
            echo json_encode($roles);
        } else if($_GET['role_id'] == 2) {
            $roles = array_splice($roles, 0, 3);
            echo json_encode($roles);
        } else if($_GET['role_id'] == 3) {
            $roles = array_splice($roles, 0, 2);
            echo json_encode($roles);
        }

    }
}