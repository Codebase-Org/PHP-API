<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
header('Content-Type: text/html');
//header('Access-Control-Allow-Methods: *');

// Including required files
include_once('../../config/Database.php');
include_once('../../config/Settings.php');
include_once('../../models/Profile.php');

$database = new Database();
$db = $database->connect();

$profil = new Profile($db);

if (isset($_GET['id']) && isset($_GET['role_id'])) {

    $data = $profil->selectTeam($_GET['id'], $_GET['role_id']);

    if ($data->rowCount()) {

        $team = [];

        while($row = $data->fetch(PDO::FETCH_OBJ)) {

            $team[] = [
                'firstname' => openssl_decrypt($row->firstname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'secondname' => openssl_decrypt($row->secondname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'lastname' => openssl_decrypt($row->lastname, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'email' => openssl_decrypt($row->email, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'onlineStatus' => $row->onlineStatus
            ];

        }

        echo json_encode($team);

    } else {
        echo json_encode(['message' => 'There is no team to get']);
    }


}