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
include_once('../../models/Profile.php');

$database = new Database();
$db = $database->connect();

$profil = new Profile($db);

$data = $profil->educations();

if($data->rowCount()) {
    $educations = [];
    while($row = $data->fetch(PDO::FETCH_OBJ)) {
        $educations[] = [
            'education_id' => $row->education_id,
            'education' => $row->education
        ];
    }

    echo json_encode($educations);
}