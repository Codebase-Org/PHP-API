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
include_once('../../models/Login.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$login = new Login($db);

if(isset($_GET['id'])) {

    if(!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $limit = 15;


    $data = $login->getPages($_GET['id']);


    if($data->rowCount()) {

        $count = $data->rowCount();
        $startingIndex = ($page - 1) * $limit;
        $numOfPages = ceil($count / $limit);


        $data1 = $login->getLoginHistory($_GET['id'], $startingIndex, $limit);
        $history = [];

        while($row = $data1->fetch(PDO::FETCH_OBJ)) {

            //print_r($row);

            $login_time = date('H:i:s', strtotime($row->login_time));
            $logout_time = date('H:i:s', strtotime($row->logout_time));
            $login_date = date('d-m-Y', strtotime($row->login_time));

            $login_time_calc = new DateTime($row->login_time);
            $logout_time_calc = new DateTime($row->logout_time);
            $time_diff = $logout_time_calc->diff($login_time_calc);

            //echo $time_diff->format('%H:%I:%S').', ';
            $online_time = $time_diff->format('%H:%I:%S');

            //echo $login_time_calc->format('Y-m-d H:i:s').', ' .$logout_time_calc->format('Y-m-d H:i:s').', ';

            //echo $login_time .'<br>'.$logout_time;

            //echo $sub_online_time = ($logout_time - $login_time)/3600;

            //echo $online_time = ($logout_time - $login_time)/(60*60);

            $history[] = [
                'loginhist_id' => $row->loginhist_id,
                'account_id' => $row->account_id,
                'login_date' => $login_date,
                'login_time' => $login_time,
                'logout_time' => $logout_time,
                'online_time' => $online_time,
                'total_pages' => $numOfPages

            ];
        }

        //print_r($history);

        echo json_encode($history);
    }
}