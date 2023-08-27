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

$data = json_decode(file_get_contents("php://input"));

if(isset($_GET['category_id'])) {

    $params = [
        'category_id' => $_GET['category_id']
    ];

    if($cat->delete($params)) {
        echo json_encode(array("message" => "Category has been deleted with success"));
    } else {
        echo json_encode(array("message" => "Something went wrong, doing category delete"));
    }

} else if(isset($data)) {

    //print_r($data);

    $params = [
        "category_id" => $data->category_id
    ];

    if($cat->delete($_GET['category_id'])) {
        echo json_encode(array("message" => "Category has been deleted with success"));
    } else {
        echo json_encode(array("message" => "Something went wrong, doing category delete"));
    }
}