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
include_once('../../models/Accounts.php');

// Connecting to the database
$database = new Database();
$db = $database->connect();

$account = new Accounts($db);

$data = json_decode(file_get_contents('php://input'));

if(isset($data)) {

    //check if account exists in the system
    $account_data = $account->accountExists($data->account_id);
    while($row = $account_data->fetch(PDO::FETCH_OBJ)) {
        $role_id = $row->role_id;
        //echo 'Role ID: ' . $role_id;
        $role_data = $account->checkRole($role_id);
        while($row1 = $role_data->fetch(PDO::FETCH_OBJ)) {
            $rolename = $row1->role_name;
            //echo 'Role: ' .$rolename;
            if($rolename != 'Owner') {
                if($account->destroy($data->account_id)) {
                    if($account->clearLoginHistory($data->account_id)) {
                        $logmsg = "Login history has been cleared out!";
                    } else {
                        $logmsg = "Something went wrong";
                    }
                    if($account->deleteProfile($data->account_id)) {
                        $promsg = "Connected profile is deleted";
                    } else {
                        $promsg = "something went wrong";
                    }
                    echo json_encode(['message' => 'Account has been deleted successfully', 'logmsg' => $logmsg, 'promsg' => $promsg]);
                } else {
                    echo json_encode(['message' => 'Account could not be deleted']);
                }

            } else {
                echo json_encode(array('message' => 'An owner can not be deleted'));
            }
        }
    }
} else if(isset($_GET['account_id'])) {
    $account_data = $account->accountExists($_GET['account_id']);
    while($row = $account_data->fetch(PDO::FETCH_OBJ)) {
        $role_id = $row->role_id;
        //echo 'Role ID: ' . $role_id;
        $role_data = $account->checkRole($role_id);
        while($row1 = $role_data->fetch(PDO::FETCH_OBJ)) {
            $rolename = $row1->role_name;
            //echo 'Role: ' .$rolename;
            if($rolename != 'Owner') {
                if($account->destroy($_GET['account_id'])) {
                    if($account->clearLoginHistory($_GET['account_id'])) {
                        $logmsg = "Login history has been cleared out!";
                    } else {
                        $logmsg = "Something went wrong";
                    }
                    if($account->deleteProfile($_GET['account_id'])) {
                        $promsg = "Connected profile is deleted";
                    } else {
                        $promsg = "something went wrong";
                    }
                    echo json_encode(['message' => 'Account has been deleted successfully', 'logmsg' => $logmsg, 'promsg' => $promsg]);
                } else {
                    echo json_encode(['message' => 'Account could not be deleted']);
                }
            } else {
                echo json_encode(array('message' => 'An owner can not be deleted'));
            }
        }
    }


}
