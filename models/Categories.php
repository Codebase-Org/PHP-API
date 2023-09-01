<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Categories {

    public $category_id;
    public $catname;
    public $picture;
    public $type_id;

    private $cat_table = 'categories';
    private $posts_table = 'posts';
    private $connection;

    public function __construct($db) {
        $this->connection = $db;
    }

    public function insert($params) {
        try {
            $this->catname = $params['catname'];
            $this->picture = $params['picture'];

            $query = 'INSERT INTO ' .$this->cat_table. ' SET 
                      catname = :catname, picture = :picture';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('catname', $this->catname);
            $stmt->bindvalue('picture', $this->picture);

            if($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function get_categories() {
        try {

            $query = 'SELECT * FROM ' .$this->cat_table. ' ORDER BY catname ASC';

            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function count_posts_categories($category_id, $type_id) {
        try {
            $this->type_id = $type_id;
            $this->category_id = $category_id;

            $query = 'SELECT * FROM '.$this->posts_table.' 
                      WHERE category_id = :category_id
                      AND post_type_id = :type_id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('category_id', $this->category_id);
            $stmt->bindValue('type_id', $this->type_id);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($params) {
        try {
            //print_r($params);
            $this->category_id = $params['category_id'];

            $query = 'DELETE FROM ' .$this->cat_table. ' WHERE category_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->category_id);

            if($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function singleCategory($id) {
        try {
            $this->category_id = $id;

            $query = 'SELECT * FROM '.$this->cat_table.' WHERE category_id = :id';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->category_id);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    public function updateCategory($params) {
        try {

            $this->category_id = $params['category_id'];
            $this->catname = $params['catname'];
            $this->picture = $params['picture'];

            $query = 'UPDATE ' .$this->cat_table. ' SET catname = :catname, picture = :picture WHERE category_id = :id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('catname', $this->catname);
            $stmt->bindValue('picture', $this->picture);
            $stmt->bindValue('id', $this->category_id);

            if($stmt->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}