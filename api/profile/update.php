<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
header('Content-Type: text/html');
header('Access-Control-Allow-Methods: *');

// Including required files
include_once('../../config/Database.php');
include_once('../../config/Settings.php');
include_once('../../models/Profile.php');

$database = new Database();
$db = $database->connect();

$profil = new Profile($db);

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_FILES['file'])) {
        $ori_fname = $_FILES['file']['name'];
        $targetPath = '../../assets/pictures/uploads/';
        $actual_fname = $_FILES['file']['name'];
        $targetPath = $targetPath . $ori_fname;

        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
            $params = [
                'firstname' => openssl_encrypt($_POST['firstname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'secondname' => openssl_encrypt($_POST['secondname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'lastname' => openssl_encrypt($_POST['lastname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'worktitle' => $_POST['worktitle'],
                'information' => $_POST['information'],
                'account_id' => $_POST['account_id'],
                'education' => $_POST['education'],
                'internship' => $_POST['internship'],
                'picture' => $_POST['picture'],
                'location' => $_POST['location'],
                'birthday' => $_POST['birthday'],
                'profile_id' => $_POST['profile_id']
            ];

            //print_r($params);

            if($profil->update($params)) {
                echo json_encode(array('message' => 'Profile has been created'));
            } else {
                echo json_encode(array('message' => 'Profile has not been created, something went wrong'));
            }
        } else {
            $params = [
                'firstname' => openssl_encrypt($_POST['firstname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'secondname' => openssl_encrypt($_POST['secondname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'lastname' => openssl_encrypt($_POST['lastname'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
                'worktitle' => $_POST['worktitle'],
                'information' => $_POST['information'],
                'account_id' => $_POST['account_id'],
                'education' => $_POST['education'],
                'internship' => $_POST['internship'],
                'location' => $_POST['location'],
                'birthday' => $_POST['birthday'],
                'profile_id' => $_POST['profile_id']
            ];

            print_r($params);

            if($profil->updateNoPicture($params)) {
                echo json_encode(array('message' => 'Profile has been created'));
            } else {
                echo json_encode(array('message' => 'Profile has not been created, something went wrong'));
            }
        }
    }
}