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

$type_id = $_GET['type_id'];

$data = $cat->get_categories();

if($data->rowCount()) {

    $categories = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $postsData = $cat->count_posts_categories($row->category_id, $type_id);

        $categories[] = [
            'category_id' => $row->category_id,
            'catname' => $row->catname,
            'picture' => $row->picture,
            'counter' => $postsData->rowCount()
        ];
    }

    echo json_encode($categories);
} else {

    echo json_encode(array('message' => 'There is no categories!'));
}