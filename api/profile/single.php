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

if(isset($_GET['id'])) {
    $data = $profil->single($_GET['id']);

    if($data->rowCount()) {

        $profile = [];

        while($row = $data->fetch(PDO::FETCH_OBJ)) {

            $profile = [
                'firstname' => openssl_decrypt($row->firstname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'secondname' => openssl_decrypt($row->secondname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'lastname' => openssl_decrypt($row->lastname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'worktitle' => $row->worktitle,
                'information' => $row->information
            ];

        }

        echo json_encode($profile);

    }
}

