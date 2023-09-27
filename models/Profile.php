<?php

class Profile
{

    public $profile_id;
    public $account_id;
    public $firstname;
    public $secondname;
    public $lastname;
    public $picture;
    public $information;
    public $worktitle;
    public $instuctor_id;
    public $role_id;

    public $education_id;
    public $education;
    public $internship;
    public $location;
    public $birthday;

    private $connection;
    private $table = 'profiles';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function insert($params)
    {

        try {

            $this->account_id = $params['account_id'];
            $this->firstname = $params['firstname'];
            $this->secondname = $params['secondname'];
            $this->lastname = $params['lastname'];
            $this->information = $params['information'];
            $this->worktitle = $params['worktitle'];
            $this->picture = $params['picture'];
            $this->education = $params['education'];
            $this->internship = $params['internship'];
            $this->location = $params['location'];
            $this->birthday = $params['birthday'];

            $query = 'INSERT INTO ' . $this->table . ' SET 
                      account_id = :account_id,
                      firstname = :firstname,
                      secondname = :secondname,
                      lastname = :lastname,
                      information = :information,
                      worktitle = :worktitle,
                      picture = :picture,
                      education = :education,
                      internship = :internship,
                      location = :location,
                      birthday = :birthday';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->bindValue('firstname', $this->firstname);
            $profil->bindValue('secondname', $this->secondname);
            $profil->bindValue('lastname', $this->lastname);
            $profil->bindValue('information', $this->information);
            $profil->bindValue('worktitle', $this->worktitle);
            $profil->bindValue('picture', $this->picture);
            $profil->bindValue('education', $this->education);
            $profil->bindValue('internship', $this->internship);
            $profil->bindValue('location', $this->location);
            $profil->bindValue('birthday', $this->birthday);

            if ($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function update($params)
    {
        try {
            $this->account_id = $params['account_id'];
            $this->firstname = $params['firstname'];
            $this->secondname = $params['secondname'];
            $this->lastname = $params['lastname'];
            $this->information = $params['information'];
            $this->worktitle = $params['worktitle'];
            $this->picture = $params['picture'];
            $this->education = $params['education'];
            $this->internship = $params['internship'];
            $this->location = $params['location'];
            $this->birthday = $params['birthday'];
            $this->profile_id = $params['profile_id'];

            $query = 'UPDATE ' . $this->table . ' SET 
                      account_id = :account_id,
                      firstname = :firstname,
                      secondname = :secondname,
                      lastname = :lastname,
                      information = :information,
                      worktitle = :worktitle,
                      picture = :picture,
                      education = :education,
                      internship = :internship,
                      location = :location,
                      birthday = :birthday 
                      WHERE profile_id = :profile_id';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->bindValue('firstname', $this->firstname);
            $profil->bindValue('secondname', $this->secondname);
            $profil->bindValue('lastname', $this->lastname);
            $profil->bindValue('information', $this->information);
            $profil->bindValue('worktitle', $this->worktitle);
            $profil->bindValue('picture', $this->picture);
            $profil->bindValue('education', $this->education);
            $profil->bindValue('internship', $this->internship);
            $profil->bindValue('location', $this->location);
            $profil->bindValue('birthday', $this->birthday);
            $profil->bindValue('profile_id', $this->profile_id);

            if ($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function updateNoPicture($params) {
        try {
            $this->account_id = $params['account_id'];
            $this->firstname = $params['firstname'];
            $this->secondname = $params['secondname'];
            $this->lastname = $params['lastname'];
            $this->information = $params['information'];
            $this->worktitle = $params['worktitle'];
            $this->education = $params['education'];
            $this->internship = $params['internship'];
            $this->location = $params['location'];
            $this->birthday = $params['birthday'];
            $this->profile_id = $params['profile_id'];

            $query = 'UPDATE ' . $this->table . ' SET 
                      account_id = :account_id,
                      firstname = :firstname,
                      secondname = :secondname,
                      lastname = :lastname,
                      information = :information,
                      worktitle = :worktitle,
                      education = :education,
                      internship = :internship,
                      location = :location,
                      birthday = :birthday 
                      WHERE profile_id = :profile_id';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->bindValue('firstname', $this->firstname);
            $profil->bindValue('secondname', $this->secondname);
            $profil->bindValue('lastname', $this->lastname);
            $profil->bindValue('information', $this->information);
            $profil->bindValue('worktitle', $this->worktitle);
            $profil->bindValue('education', $this->education);
            $profil->bindValue('internship', $this->internship);
            $profil->bindValue('location', $this->location);
            $profil->bindValue('birthday', $this->birthday);
            $profil->bindValue('profile_id', $this->profile_id);

            if ($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function single($account_id)
    {

        try {

            $this->account_id = $account_id;

            $query = 'SELECT p.firstname, p.secondname, p.lastname,
                      p.picture, p.information, p.worktitle, p.education, p.internship, p.birthday, p.location, p.account_id, p.profile_id,
                      a.created_date, a.end_date, a.email, a.onlineStatus 
                      FROM ' . $this->table . ' p LEFT JOIN accounts a ON a.account_id = p.account_id WHERE p.account_id = :account_id';

            $profil = $this->connection->prepare($query);
            $profil->bindValue('account_id', $this->account_id);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function selectTeam($instuctor_id, $role_id)
    {
        try {

            $this->instuctor_id = $instuctor_id;
            $this->role_id = $role_id;

            $query = 'SELECT p.firstname, p.secondname, p.lastname, a.username, a.email, a.onlineStatus FROM ' . $this->table . ' p LEFT JOIN accounts a ON a.account_id = p.account_id WHERE instructor_id = :instructor_id AND role_id = :role_id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('instructor_id', $this->instuctor_id);
            $stmt->bindValue('role_id', $this->role_id);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function educations()
    {
        try {

            $query = 'SELECT * FROM educations';
            $stmt = $this->connection->prepare($query);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function selectSpecificAccountsFromRoles($role_id)
    {
        try {

            $this->role_id = $role_id;

            $query = 'SELECT 
                        p.firstname, 
                        p.secondname, 
                        p.lastname, 
                        a.account_id 
                        FROM ' . $this->table . ' p 
                        LEFT JOIN accounts a 
                        ON a.account_id = p.account_id 
                        WHERE role_id = :role_id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindValue('role_id', $this->role_id);
            $stmt->execute();

            return $stmt;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkIfProfileExist($account_id)
    {

        try {

            $this->account_id = $account_id;

            $query = 'SELECT * FROM ' . $this->table . ' WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $this->account_id);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

    public function getProfiles()
    {

        try {

            $query = 'SELECT r.role_name as rolename,
            a.role_id, a.username, a.account_id, a.email, a.onlineStatus
            FROM accounts a LEFT JOIN roles r ON
            r.role_id = a.role_id';
            $profil = $this->connection->prepare($query);
            $profil->execute();

            return $profil;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }

    public function deleteProfile($id)
    {
        try {
            $query = 'DELETE FROM ' . $this->table . ' WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $id);

            if ($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAccount($id)
    {
        try {
            $query = 'DELETE FROM accounts WHERE account_id = :id';
            $profil = $this->connection->prepare($query);
            $profil->bindValue('id', $id);

            if ($profil->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}