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

$data = json_decode(file_get_contents('php://input'));

if(count($_POST)) {
    $params = [
        'account_id' => $_POST['account_id'],
        'role_id' => $_POST['role_id'],
        'email' => $_POST['email'],
        'start_date' => $_POST['start_date'],
        'instructor_id' => $_POST['instructor_id'],
        'end_date' => $_POST['end_date'],
    ];

    if($account->update($params)) {
        echo json_encode(array('message' => 'Account has been added successfully.'));
    } else {
        echo json_encode(array('message' => 'Account has not been added, something went wrong.'));
    }
} else if(isset($data)) {
    $params = [
        'account_id' => $data->account_id,
        'role_id' => $data->role_id,
        'email' => $data->email,
        'start_date' => $data->start_date,
        'instructor_id' => $data->instructor_id,
        'end_date' => $data->end_date,
    ];

    if($account->update($params)) {
        echo json_encode(array('message' => 'Account has been added successfully.'));
    } else {
        echo json_encode(array('message' => 'Account has not been added, something went wrong.'));
    }
}
