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
include_once('../../models/Types.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$ty = new Types($db);

if(isset($_GET['type_id'])) {

     $params = [
         'post_type_id' => $_GET['type_id']
     ];

     $data = $ty->single($params);

     if($data->rowCount()) {
         $type = [];
         while($row = $data->fetch(PDO::FETCH_OBJ)) {
             $type = [
                 'post_type_id' => $row->post_type_id,
                 'post_type_title' => $row->post_type_title
             ];
         }

         echo json_encode($type);
     } else {
         echo json_encode(array('message' => 'Something went wrong'));
     }
}