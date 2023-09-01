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

if($_SERVER['REQUEST_METHOD'] === "POST") {
  $ori_filename = $_FILES['file']['name'];
  $target_path = '../../assets/img/logo/';
  $target_path = $target_path . $ori_filename;

  if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
      $params = [
          'catname' => $_POST['catname'],
          'picture' => $_POST['picture'],
          'category_id' => $_POST['category_id']
      ];

      if($cat->updateCategory($params)) {
          $msg = 'Category has been updated, and file has been uploaded.';
      }
  } else {
      $msg = 'Update and file upload failed. Please try again.';
  }

  echo json_encode(['message' => $msg]);
}