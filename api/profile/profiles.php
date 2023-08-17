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

$data = $profil->getProfiles();

if ($data->rowCount()) {

    $profiles = [];

    while($row = $data->fetch(PDO::FETCH_OBJ)) {

        $profilData = $profil->checkIfProfileExist($row->account_id);

        if($profilData->rowCount()) {

            while($row1 = $profilData->fetch(PDO::FETCH_OBJ)) {

                $profiles[] = [
                    'account_id' => $row->account_id,
                    'role' => $row->rolename,
                    'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                    'email' => openssl_decrypt($row->email, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                    'status' => 'true',
                    'profile_id' => $row1->profile_id
                ];

            }

        } else {

            $profiles[] = [
                'account_id' => $row->account_id,
                'role' => $row->rolename,
                'username' => openssl_decrypt($row->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'email' => openssl_decrypt($row->email, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'status' => 'false'
            ];

        }

    }

    echo json_encode($profiles);
}