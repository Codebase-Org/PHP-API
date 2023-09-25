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
include_once('../../models/Accounts.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$account = new Accounts($db);

$data = json_decode(file_get_contents('php://input'));

if(count($_POST)) {
    $params = [
        'username' => openssl_encrypt($_POST['username'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'password' => $_POST['password'],
        'email' => openssl_encrypt($_POST['email'], OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'role_id' => $_POST['role_id'],
        'created_date' => date("Y-m-d H:i:s"),
    ];

    if($account->insert($params)) {
//        $to = $_POST['email'];
//        $subject = "Welcome to Codebase";
//        $message = '
//            Hello '.$_POST['username'].'<br><br>
//            Welcome to Codebase forum, which is a tool for students. Where you can search for help, or you can help others.<br><br>
//            Your login information:<br><br>
//            Username: '.$_POST['email'].'<br>
//            Password: '.$_POST['password'].'<br>
//            <br>
//            Go to the website by clicking on the link below.<br>
//            <a href="192.168.22.21">Codebase website click here</a><br>
//            <br>
//            Greetings<br>
//            Codebase Teamet.
//        ';
//        $headers = "From: info@localhost.local" . "\r\n" .
//            "Reply-To: No-Reply" . "\r\n" .
//            "X-Mailer: PHP/" . phpversion();
//        if(mail($to, $subject, $message, $headers)) {
//            $msg = "Mail has been sent to {$data->email}";
//        } else {
//            $msg = "Mail could not be send.";
//        }
//        echo json_encode(array('message' => 'Account has been added successfully. and mail has been sent to ' . $_POST['email'] . '.'));
    } else {
        echo json_encode(array('message' => 'Account has not been added, something went wrong.'));
    }
} else if(isset($data)) {
    $params = [
        'username' => openssl_encrypt($data->username, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'password' => $data->password,
        'email' => openssl_encrypt($data->email, OPENSSL_CIPHERING, OPENSSL_ENCRYP_KEY, OPENSSL_OPTIONS, OPENSSL_ENCRYPT_IV),
        'role_id' => $data->role_id,
        'created_date' => date("Y-m-d H:i:s"),
    ];

    if($account->insert($params)) {
//        $to = $data->email;
//        $subject = "Welcome to Codebase";
//        $message = '
//            Hello '.$data->username.'<br><br>
//            Welcome to Codebase forum, which is a tool for students. Where you can search for help, or you can help others.<br><br>
//            Your login information:<br><br>
//            Username: '.$data->email.'<br>
//            Password: '.$data->password.'<br>
//            <br>
//            Go to the website by clicking on the link below.<br>
//            <a href="192.168.22.21">Codebase website click here</a><br>
//            <br>
//            Greetings<br>
//            Codebase Teamet.
//        ';
//        $headers = "From: info@localhost.local" . "\r\n" .
//                   "Reply-To: No-Reply" . "\r\n" .
//                   "X-Mailer: PHP/" . phpversion();
//        if(mail($to, $subject, $message, $headers)) {
//            $msg = "Mail has been sent to {$data->email}";
//        } else {
//            $msg = "Mail could not be send.";
//        }
//        echo json_encode(array('message' => 'Account has been added successfully.', 'email' => $msg));
    } else {
        echo json_encode(array('message' => 'Account has not been added, something went wrong.'));
    }
}