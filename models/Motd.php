<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Motd {

    public $motd_id;
    public $title;
    public $message;
    public $account_id;
    public $motd_date;

    private $connection;
    private $table = 'motds';

    public function __construct($db) {
        $this->connection = $db;
    }


    /**
     * @OA\Post(
     *     path="/api/motd/insert.php",
     *     summary="Method to create a new message for everyone",
     *     tags={"Message Of The Day"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="account_id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property (
     *                      property="title",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="message",
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
            $this->title = $params['title'];
            $this->message = $params['message'];
            $this->account_id = $params['account_id'];

            $query = 'INSERT INTO ' .$this->table . ' 
            SET title = :title,
            account_id = :account_id, 
            message = :message';

            $msg = $this->connection->prepare($query);
            $msg->bindValue('account_id', $this->account_id);
            $msg->bindValue('title', $this->title);
            $msg->bindValue('message', $this->message);

            if($msg->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/motd/messages.php",
     *     summary="Method to read all messsages from database",
     *     tags={"Message Of The Day"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function getAllMessages() {
        try {

            $query = 'SELECT a.firstname as firstname,
                      a.secondname as secondname,
                      a.lastname as lastname,
                      m.title, m.message, m.motd_date, m.account_id FROM ' . $this->table . ' m 
                      LEFT JOIN accounts a ON
                      a.account_id = m.account_id ORDER BY m.motd_date DESC';

            $motd = $this->connection->prepare($query);
            $motd->execute();

            return $motd;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Get(
     *     path="/api/motd/single.php",
     *     summary="Method to read single single from database",
     *     tags={"Message Of The Day"},
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
    public function single($motd_id) {
        try {

            $this->motd_id = $motd_id;

            $query = 'SELECT a.account_id as account,
                      m.title, m.message, m.motd_date, m.account_id FROM ' . $this->table . ' m 
                      LEFT JOIN accounts a ON
                      a.account_id = m.account_id WHERE m.motd_id = :id';

            $motd = $this->connection->prepare($query);
            $motd->bindValue('id', $this->motd_id);
            $motd->execute();

            return $motd;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Delete(
     *     path="/api/motd/destroy.php",
     *     summary="Method to delete message from database",
     *     tags={"Message Of The Day"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="motd_id",
     *                      type="integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function delete($motd_id) {
        try {

            $this->motd_id = $motd_id;

            $query = 'DELETE FROM ' . $this->table . ' WHERE motd_id = :id';
            $motd = $this->connection->prepare($query);
            $motd->bindValue('id', $this->motd_id);

            if($motd->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}