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

$data = $faq->faqs();

if($data->rowCount()) {

    $faqs = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {

        $faqs[$row->faq_id] = [
            'faq_id' => $row->faq_id,
            'faq_title' => $row->faq_title,
            'faq_content' => $row->faq_content,
            'faq_created_date' => $row->faq_created_date,
            'faq_updated_date' => $row->faq_updated_date
        ];

    }

    echo json_encode($faqs);
} else {
    echo json_encode(array('message' => 'There is nothing to be shown'));
}