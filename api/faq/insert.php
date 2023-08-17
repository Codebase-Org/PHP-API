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
include_once('../../models/Faq.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$faq = new Faq($db);

$data = json_decode(file_get_contents('php://input'));

if(count($_POST)) {

    $params = [
        'faq_title' => $_POST['faq_title'],
        'faq_content' => $_POST['faq_content']
    ];

    if($faq->insert($params)) {
        echo json_encode(array('message' => 'Faq post has been added successfully'));
    } else {
        echo json_encode(array('message' => 'Faq post could not be added'));
    }

} else if(isset($data)) {

    $params = [
        'faq_title' => $data->faq_title,
        'faq_content' => $data->faq_content
    ];

    if($faq->insert($params)) {
        echo json_encode(array('message' => 'Faq post has been added successfully'));
    } else {
        echo json_encode(array('message' => 'Faq post could not be added'));
    }
}