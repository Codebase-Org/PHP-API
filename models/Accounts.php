<?php
define('PASSWORD_HASH_KEY', 'AngelsFlyingHigh2003MilesAway');

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Accounts {


    public $account_id;
    public $username;
    public $password;
    public $email;
    public $firstname;
    public $secondname;
    public $lastname;
    public $picture;
    public $role_id;
    public $instructor_id;
    public $role_name;
    public $information;
    public $worktitle;
    public $created_date;
    public $end_date;
    public $created_at;

    private $connection;
    private $table = 'accounts';

    public function __construct($db) {
        $this->connection = $db;
    }

    /**
     * @OA\Post(
     *     path="/api/account/insert.php",
     *     summary="Method to create a new account",
     *     tags={"Accounts"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="username",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="password",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="email",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="role_id",
     *                      type="integer",
     *                  ),
     *                 @OA\Property (
     *                      property="created_date",
     *                      type="string",
     *                  ),
     *                 @OA\Property (
     *                      property="end_date",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function insert($params) {
        try{
            $this->username = $params['username'];
            $this->password = $params['password'];
            //$this->password = $params['password'];
            $this->email = $params['email'];
            $this->role_id = $params['role_id'];
            $this->created_date = $params['created_date'];

            $query = 'INSERT INTO ' .$this->table. ' SET 
            username = :username,
            password = :password,
            email = :email,
            role_id = :role_id,
            created_date = :created_date';

            $account = $this->connection->prepare($query);
            $account->bindValue('username', $this->username);
            $account->bindValue('password', hash_hmac('sha512', $this->password, PASSWORD_HASH_KEY));
            $account->bindValue('email', $this->email);
            $account->bindValue('role_id', $this->role_id);
            $account->bindValue('created_date', $this->created_date);

            if($account->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/account/accounts.php",
     *     summary="Method to read all the saved accounts from database",
     *     tags={"Accounts"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function accounts() {
        try{
            $query = 'SELECT r.role_name as rolename,
                      a.account_id,
                      a.username, 
                      a.email, 
                      a.created_date, 
                      a.end_date FROM ' . $this->table . ' a 
                      LEFT JOIN roles r 
                      ON r.role_id = a.role_id ORDER BY a.username ASC';

            $accounts = $this->connection->prepare($query);
            $accounts->execute();

            return $accounts;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/account/single.php",
     *     summary="Method to read single account from database",
     *     tags={"Accounts"},
     *     @OA\Parameter (
     *          name="id",
     *          in="query",
     *          required=true,
     *          description="The id passed to get data like in query string",
     *          @OA\Schema (
     *              type="string",
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function get_single_account($id) {
        try {
            $query = 'SELECT r.role_name as rolename,
                      a.account_id,
                      a.username, 
                      a.email, 
                      a.created_date, 
                      a.end_date,
                      a.role_id
                      FROM ' . $this->table . ' a 
                      LEFT JOIN roles r 
                      ON r.role_id = a.role_id WHERE a.account_id = :id LIMIT 0,1';

            $accounts = $this->connection->prepare($query);
            $accounts->bindValue('id', $id);
            $accounts->execute();

            return $accounts;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/account/check.php",
     *     summary="Method to check if there is an Owner in the database",
     *     tags={"Accounts"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function CheckOwnerExist() {
        try {

            $query = 'SELECT r.role_name as rolename,
            a.role_id FROM ' .$this->table. ' a 
            LEFT JOIN roles r 
            ON r.role_id = a.role_id';

            $owner = $this->connection->prepare($query);
            $owner->execute();

            return $owner;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Put(
     *     path="/api/account/update.php",
     *     summary="Method to update an existing account",
     *     tags={"Accounts"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="account_id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property (
     *                      property="email",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="role_id",
     *                      type="integer",
     *                  ),
     *                 @OA\Property (
     *                      property="created_date",
     *                      type="string",
     *                  ),
     *                 @OA\Property (
     *                      property="end_date",
     *                      type="string",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function update($params) {
        try{
            $this->account_id = $params['account_id'];
            $this->role_id = $params['role_id'];
            $this->email    = $params['email'];
            $this->instructor_id = $params['instructor_id'];
            $this->start_date = $params['start_date'];
            $this->end_date = $params['end_date'];

            $query = 'UPDATE ' .$this->table. ' SET 
            role_id = :role_id,
            instructor_id = :instructor_id,
            end_date = :end_date WHERE account_id = :id';

            $account = $this->connection->prepare($query);
            $account->bindValue('id', $this->account_id);
            $account->bindValue('role_id', $this->role_id);
            $account->bindValue('instructor_id', $this->instructor_id);
            $account->bindValue('end_date', $this->end_date);

            if($account->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/account/destroy.php",
     *     summary="Method to delete account from database",
     *     tags={"Accounts"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="account_id",
     *                      type="integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function destroy($id) {
        try {
            $this->account_id = $id;
            $query = 'DELETE FROM '.$this->table.' WHERE account_id = :id';
            $role = $this->connection->prepare($query);
            $role->bindValue('id', $this->account_id);

            if($role->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function accountExists($id) {
        try {
            $this->account_id = $id;
            $query = 'SELECT role_id FROM '.$this->table.' WHERE account_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->account_id);
            if($stmt->execute()) {
                return $stmt;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkRole($role_id) {
        try {
            $this->role_id = $role_id;
            $query = 'SELECT role_name FROM roles WHERE role_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->role_id);
            if($stmt->execute()) {
                return $stmt;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function clearLoginHistory($id) {
        try {
            $this->account_id = $id;
            $query = 'DELETE FORM loginhistory WHERE account_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->account_id);
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteProfile($id) {
        try {
            $this->account_id = $id;
            $query = 'DELETE FROM profile WHERE account_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->account_id);
            if($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/account/counter.php",
     *     summary="Method to check if there is an Owner in the database",
     *     tags={"Accounts"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function countAccounts() {
        try {
            $query = 'SELECT * FROM ' .$this->table;

            $accounts = $this->connection->prepare($query);
            $accounts->execute();

            return $accounts;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function studentCounter($role_id) {
        try {

            $this->role_id = $role_id;

            $query = 'SELECT * FROM ' .$this->table. ' WHERE role_id = :role_id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('role_id', $this->role_id);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}