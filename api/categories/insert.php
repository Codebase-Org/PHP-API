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
include_once('../../models/Categories.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$cat = new Categories($db);

$data = json_decode(file_get_contents('php://input'));

if(count($_POST)) {

    $params = [
        'catname' => $_POST['catname'],
        'picture' => $_FILES['picture']
    ];

    if($cat->insert($params)) {
        echo json_encode(array('message' => 'Category '.$_POST['catname'].' has been created'));
    } else {
        echo json_encode(array('message' => 'Category '.$_POST['catname'].' Could not be created. Something went wrong!'));
    }

} else if(isset($data)) {

    $params = [
        'catname' => $data->catname,
        'picture' => $data->picture
    ];

    if($cat->insert($params)) {
        echo json_encode(array('message' => 'Category '.$data->catname.' has been created'));
    } else {
        echo json_encode(array('message' => 'Category '.$data->catname.' Could not be created. Something went wrong!'));
    }

}