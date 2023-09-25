<?php

define('PASSWORD_HASH_KEY', 'AngelsFlyingHigh2003MilesAway');

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Login {

    public $loginhist_id;
    public $account_id;
    public $username;
    public $password;
    public $limit;
    public $page;
    public $onlineStatus;

    private $connection;
    private $table = 'accounts';
    private $tableHist = 'loginhistory';

    public function __construct($db) {
        $this->connection = $db;
    }


    /**
     * @OA\Get(
     *     path="/api/login/login.php",
     *     summary="Method to get authenticated",
     *     tags={"Login"},
     *     @OA\Parameter (
     *          name="username",
     *          in="query",
     *          required=true,
     *          description="Username for account login",
     *          @OA\Schema (
     *              type="string",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="password",
     *          in="query",
     *          required=true,
     *          description="Password for account login",
     *          @OA\Schema (
     *              type="string",
     *          ),
     *     ),
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * ),
     */
    public function login($params) {
        try {
            $this->username = $params['email'];
            $this->password = $params['password'];

            //echo 'Username: ' . $this->username . '<br>';
            //echo 'Password: ' . $this->password;

            $query = 'SELECT
                      r.role_name as rolename,
                      a.account_id,
                      r.role_id
                      FROM '.$this->table.' a LEFT JOIN
                      roles r ON r.role_id = a.role_id WHERE
                      a.email = :username AND a.password = :password
                      LIMIT 0,1';

            $stmt = $this->connection->prepare($query);

            $stmt->bindValue('username', $this->username);
            $stmt->bindValue('password', $this->password);
            //$stmt->bindValue('password', $this->password);

            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function loginHistory($account_id) {
        try {
            $this->account_id = $account_id;

            $query = 'INSERT into ' . $this->tableHist .' SET account_id = :id, login_time = CURRENT_TIME';
            $log = $this->connection->prepare($query);
            $log->bindValue('id', $this->account_id);

            if($log->execute()) {
                $last_insert_id = $this->connection->lastInsertId();
                return $last_insert_id;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\PUT(
     *     path="/api/login/logout.php",
     *     summary="Method to update an existing login session and logging out",
     *     tags={"Login"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="loginID",
     *                      type="integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function logoutHistory($loginhist_id) {
        try {
            $this->loginhist_id = $loginhist_id;

            $query = 'UPDATE ' . $this->tableHist . ' SET 
            logout_time = CURRENT_TIME 
            WHERE 
            loginhist_id = :id';

            $log = $this->connection->prepare($query);
            $log->bindValue('id', $this->loginhist_id);

            if($log->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/login/history.php",
     *     summary="Method to show login history for a specific user",
     *     tags={"Login"},
     *     @OA\Parameter (
     *          name="id",
     *          in="query",
     *          required=true,
     *          description="Insert account_id to get login history",
     *          @OA\Schema (
     *              type="string",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="page",
     *          in="query",
     *          required=false,
     *          description="Insert account_id to get login history",
     *          @OA\Schema (
     *              type="integer",
     *          ),
     *     ),
     *     @OA\Parameter (
     *          name="limit",
     *          in="query",
     *          required=false,
     *          description="Insert account_id to get login history",
     *          @OA\Schema (
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * ),
     */
    public function getLoginHistory($account_id) {
        try {
            $this->account_id = $account_id;

            $query = 'SELECT 
                      loginhist_id, 
                      account_id, 
                      login_time, logout_time FROM ' .$this->tableHist . ' 
                      WHERE 
                      account_id = :id 
                      ORDER BY 
                      login_time DESC 
                      ';

            $hist = $this->connection->prepare($query);
            $hist->bindValue('id', $this->account_id);
            //$hist->bindValue('start_from', $this->page);
            //$hist->bindValue('limit', $this->limit);
            $hist->execute();

            return $hist;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPages($account_id) {
        try {
            $this->account_id = $account_id;


            $query = 'SELECT 
                      loginhist_id, 
                      account_id, 
                      login_time, logout_time FROM ' .$this->tableHist . ' 
                      WHERE 
                      account_id = :id 
                      ORDER BY 
                      login_time DESC
                      ';

            $hist = $this->connection->prepare($query);
            $hist->bindValue('id', $this->account_id);

            $hist->execute();

            return $hist;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateOnlineStatus($account_id, $onlineStatus) {
        try {

            $this->account_id = $account_id;
            $this->onlineStatus = $onlineStatus;

            $query = 'UPDATE ' .$this->table. ' SET onlineStatus = :onlineStatus WHERE account_id = :account_id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('account_id', $this->account_id);
            $stmt->bindValue('onlineStatus', $this->onlineStatus);

            if($stmt->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}