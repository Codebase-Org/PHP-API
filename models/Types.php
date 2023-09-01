<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Types {

    public $post_type_id;
    public $post_type_title;

    private $connection;
    private $table = 'post_types';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function single($params) {
        try {
            $this->post_type_id = $params['post_type_id'];

            $query = 'SELECT * FROM '.$this->table.' WHERE post_type_id = :id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->post_type_id);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}