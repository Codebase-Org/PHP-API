<?php

class Database {

    private $host = 'localhost';
    private $database = 'codebase';
    private $username = 'codebase';
    private $password = "Passw0rd";
    private $connection = null;

    public function connect() {
        try {
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password);
            //echo 'Connection established successfully';
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        return $this->connection;
    }
}