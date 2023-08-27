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
include_once('../../models/Posts.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$posts = new Posts($db);

$data = $posts->getPostTypes();

if($data->rowCount()) {

    $post_types = [];
    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $post_types[] = [
            'post_type_id' => $row->post_type_id,
            'post_type_title' => $row->post_type_title
        ];
    }

    echo json_encode($post_types);
} else {
    echo json_encode(array('message' => 'Nothing to show'));
}