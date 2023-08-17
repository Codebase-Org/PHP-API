<?php

class Profile {

    public $profile_id;
    public $account_id;
    public $firstname;
    public $secondname;
    public $lastname;
    public $picture;
    public $information;
    public $worktitle;

    private $connection;
    private $table = 'profile';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function insert($params) {

        try {

            $this->account_id = $params['account_id'];
            $this->firstname = $params['firstname'];
            $this->secondname = $params['secondname'];
            $this->lastname = $params['lastname'];
            $this->information = $params['information'];
            $this->worktitle = $params['worktitle'];

            $query = 'INSERT INTO ' .$this->table. ' SET 
                      account_id = :account_id,
                      firstname = :firstname,
                      secondname = :secondname,
                      lastname = :lastname,
                      information = :information,
                      worktitle = :worktitle';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->bindValue('firstname', $this->firstname);
            $profil->bindValue('secondname', $this->secondname);
            $profil->bindValue('lastname', $this->lastname);
            $profil->bindValue('information', $this->information);
            $profil->bindValue('worktitle', $this->worktitle);

            if($profil->execute()) {
                return true;
            }

            return false;

        } catch(PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function single($account_id) {

        try {

            $this->account_id = $account_id;

            $query = 'SELECT p.firstname, p.secondname, p.lastname,
                      p.picture, p.information, p.worktitle 
                      FROM '.$this->table.' p WHERE account_id = :account_id';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function checkIfProfileExist($account_id) {

        try {

            $this->account_id = $account_id;

            $query = 'SELECT * FROM ' .$this->table. ' WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $this->account_id);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

    public function getProfiles() {

        try {

            $query = 'SELECT r.role_name as rolename,
            a.role_id, a.username, a.account_id, a.email
            FROM accounts a LEFT JOIN roles r ON
            r.role_id = a.role_id';
            $profil = $this->connection->prepare($query);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function deleteProfile($id) {
        try {
            $query = 'DELETE FROM ' . $this->table . ' WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $id);

            if($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAccount($id) {
        try {
            $query = 'DELETE FROM accounts WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $id);

            if($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}