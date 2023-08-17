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

if(isset($_GET['id'])) {

    if($faq->destroy($_GET['id'])) {

        echo json_encode(array('message' => 'faq post has been deleted successfully'));

    } else {

        echo json_encode(array('message' => 'faq post could not be deleted, because it was not found'));

    }
} else if(isset($data)) {

    if($faq->destroy($data->faq_id)) {

    }
        echo json_encode(array('message' => 'faq post has been deleted successfully'));

    } else {

        echo json_encode(array('message' => 'faq post could not be deleted, because it was not found'));
}