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

if(isset($_GET['id'])) {

    $data = $cat->singleCategory($_GET['id']);

    //print_r($data);

    $category = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {

        $category = [
            'category_id' => $row->category_id,
            'catname' => $row->catname,
            'picture' => $row->picture
        ];
    }

    echo json_encode($category);
} else {
    echo json_encode(array('message', "Something went wrong"));
}

