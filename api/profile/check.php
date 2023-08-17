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

$check = new Profile($db);

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $data = $check->checkIfProfileExist($id);

    if($data->rowCount()) {

        echo json_encode(array('message' => 'Profile is created', 'status' => false));

    } else {

        echo json_encode(array('message' => 'Please create a profile', 'status' => true));

    }

}
