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

if(isset($_GET['id'])) {
    $params = [
        'category_id' => $_GET['id']
    ];

    $data = $posts->getPosts($params);

    //print_r($data);

    if($data->rowCount()) {
        $forumData = [];
        while($row = $data->fetch(PDO::FETCH_OBJ)) {
            //print_r($row);
            $forumData[] = [
                'post_headline' => $row->post_headline,
                'post_content' => $row->post_content,
                'post_time' => date('d.m.Y H:i:s', strtotime($row->post_time)),
                'post_type_id' => $row->post_type_id,
                'account_id' => $row->account_id,
                'post_id' => $row->post_id,
                'post_views' => $row->post_views,
                'post_type_title' => $row->post_type_title,
                'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV)
            ];
        }
        echo json_encode($forumData);
    } else {
        $message = [
            'message' => 'There is no posts to be shown'
        ];
        echo json_encode($message);
    }
} else if(isset($input)) {
    $params = [
        'category_id' => $input->id
    ];

    $data = $posts->getPosts($params);
    if($data->rowCount()) {
        $forumData = [];
        while($row = $data->fetch(PDO::FETCH_OBJ)) {
            $forumData[] = [
                'post_headline' => $row->post_headline,
                'post_content' => $row->post_content,
                'post_time' => date('d.m.Y H:i:s', strtotime($row->post_time)),
                'post_type_id' => $row->post_type_id,
                'account_id' => $row->account_id,
                'post_id' => $row->post_id,
                'post_views' => $row->post_views,
                'post_type_title' => $row->post_type_title,
                'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV)
            ];
        }
        echo json_encode($forumData);
    } else {
        echo json_encode(array('message' => 'There is no posts to be shown'));
    }
}