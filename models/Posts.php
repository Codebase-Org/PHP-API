<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Posts {

    public $post_id;
    public $category_id;
    public $account_id;
    public $post_headline;
    public $post_content;
    public $post_time;
    public $post_update;
    public $post_type_id;
    public $post_views;

    private $connection;
    private $posts_table = "posts";
    private $types_table = "post_types";
    private $cat_table = "categories";
    private $acco_table = "accounts";

    public function __construct($db) {
        $this->connection = $db;
    }

    public function insert($params) {
        try {

            $this->category_id = $params['category_id'];
            $this->account_id = $params['account_id'];
            $this->post_headline = $params['post_headline'];
            $this->post_content = $params['post_content'];
            $this->post_type_id = $params['post_type_id'];
            $this->post_views = $params['post_views'];

            $query = 'INSERT INTO '.$this->posts_table.' SET
                      category_id = :category_id,
                      account_id = :account_id,
                      post_headline = :post_headline,
                      post_content = :post_content,
                      post_type_id = :post_type_id,
                      post_views = :post_views,
                      post_time = CURRENT_TIME';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('category_id', $this->category_id);
            $stmt->bindValue('account_id', $this->account_id);
            $stmt->bindValue('post_headline', $this->post_headline);
            $stmt->bindValue('post_content', $this->post_content);
            $stmt->bindValue('post_type_id', $this->post_type_id);
            $stmt->bindValue('post_views', $this->post_views);

            if($stmt->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPostTypes() {
        try {
            $query = 'SELECT * FROM '.$this->types_table.' ORDER BY post_type_title';

            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPosts($params) {
        try {
            $this->category_id = $params['category_id'];

            $query = 'SELECT p.post_headline, p.post_content, p.post_time, p.post_update, p.post_views, p.post_type_id, p.account_id, p.post_id, 
                      t.post_type_title, a.username FROM '.$this->posts_table.' p LEFT JOIN '.$this->types_table.' t 
                      ON t.post_type_id = p.post_type_id 
                      LEFT JOIN '.$this->acco_table.' a ON a.account_id = p.account_id 
                      WHERE p.category_id = :id ORDER BY p.post_time, p.post_headline ASC';
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('id', $this->category_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}