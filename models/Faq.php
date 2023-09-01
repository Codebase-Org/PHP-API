<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Faq {

    public $faq_id;
    public $faq_title;
    public $faq_content;
    private $connection;
    private $table = 'faq';

    public function __construct($db) {
        $this->connection = $db;
    }

    /**
     * @OA\Post(
     *     path="/api/faq/insert.php",
     *     summary="Method to create a new post in faq",
     *     tags={"Frequently Asked Question"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="faq_title",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="faq_content",
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
        try {

            $this->faq_title = $params['faq_title'];
            $this->faq_content = $params['faq_content'];

            $query = 'INSERT INTO ' .$this->table.' SET
                      faq_title = :faq_title, 
                      faq_content = :faq_content';

            $faq = $this->connection->prepare($query);
            $faq->bindValue('faq_title', $this->faq_title);
            $faq->bindValue('faq_content', $this->faq_content);

            if($faq->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/faq/faqs.php",
     *     summary="Method to read all faqs from database",
     *     tags={"Frequently Asked Question"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function faqs() {
        try {

            $query = 'SELECT faq_id, 
                      faq_title, 
                      faq_content, 
                      faq_time 
                      FROM ' .$this->table . ' ORDER BY faq_title ASC';

            $faq = $this->connection->prepare($query);
            $faq->execute();

            return $faq;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/faq/single.php",
     *     summary="Method to read single faq from database",
     *     tags={"Frequently Asked Question"},
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
    public function single($faq_id) {
        try {

            $this->faq_id = $faq_id;

            $query = 'SELECT faq_id,
                      faq_title,
                      faq_content,
                      faq_time
                      FROM ' . $this->table . ' 
                      WHERE faq_id = :id';

            $faq = $this->connection->prepare($query);
            $faq->bindValue('id', $this->faq_id);
            $faq->execute();

            return $faq;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Put(
     *     path="/api/faq/update.php",
     *     summary="Method to update an existing faq in the database",
     *     tags={"Frequently Asked Question"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="faq_id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property (
     *                      property="faq_title",
     *                      type="string",
     *                  ),
     *                  @OA\Property (
     *                      property="faq_content",
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
        try {

            $this->faq_id = $params['faq_id'];
            $this->faq_title = $params['faq_title'];
            $this->faq_content = $params['faq_content'];

            $query = 'UPDATE ' . $this->table . ' SET 
                     faq_title = :faq_title,
                     faq_content = :faq_content,
                     WHERE faq_id = :faq_id
                     ';
            $faq = $this->connection->prepare($query);

            $faq->bindValue('faq_title', $this->faq_title);
            $faq->bindValue('faq_content', $this->faq_content);
            $faq->bindValue('faq_id', $this->faq_id);

            if($faq->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/faq/destroy.php",
     *     summary="Method to delete faq from database",
     *     tags={"Frequently Asked Question"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="faq_id",
     *                      type="integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function destroy($faq_id) {
        try {

            $this->faq_id = $faq_id;

            $query = 'DELETE FROM ' .$this->table.' WHERE faq_id = :id';
            $faq = $this->connection->prepare($query);
            $faq->bindValue('id', $this->faq_id);

            if($faq->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}