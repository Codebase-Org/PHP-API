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

$input = json_decode(file_get_contents("php://input"));

if(count($_POST)) {
    $params = [
        'category_id' => $_POST['category_id'],
        'account_id' => $_POST['account_id'],
        'post_headline' => $_POST['post_headline'],
        'post_content' => $_POST['post_content'],
        'post_type_id' => $_POST['post_type_id'],
        'post_views' => 0
    ];

    if($posts->insert($params)) {
        echo json_encode(array('message' => 'Post has been created with success'));
    } else {
        echo json_encode(array('message' => 'Something went wrong'));
    }
} else if(isset($input)) {
    $params = [
        'category_id' => $input->category_id,
        'account_id' => $input->account_id,
        'post_headline' => $input->post_headline,
        'post_content' => $input->post_content,
        'post_type_id' => $input->post_type_id,
        'post_views' => 0
    ];

    if($posts->insert($params)) {
        echo json_encode(array('message' => 'Post has been created with success'));
    } else {
        echo json_encode(array('message' => 'Something went wrong'));
    }

}