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

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ori_filename = $_FILES['file']['name'];
    $targetPath = '../../assets/img/logo/';
    $targetPath = $targetPath . $ori_filename;

    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {

        $params = [
            'catname' => $_POST['catname'],
            'picture' => $_POST['picture']
        ];

        if($cat->insert($params)) {
            $msg = 'Category and logo has been create and uploaded successfully.';
        }
    } else {
        $msg = 'Category and logo upload failed. Please try again.';
    }

    echo json_encode(['message' => $msg]);
}

