<?php

/**
 * @OA\Info(title="CODE-BASE REST API BETA", version="1.0")
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
class Roles {

    public $role_id;
    public $role_name;
    public $create_at;

    private $connection = null;
    private $table = 'roles';

    public function __construct($db) {
        $this->connection = $db;
    }


    /**
     * @OA\Post(
     *     path="/api/roles/insert.php",
     *     summary="Method to create a new role",
     *     tags={"Roles"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="role_name",
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
            $this->role_name = $params['role_name'];

            $query = 'INSERT INTO ' .$this->table. ' SET role_name = :role_name';
            $role = $this->connection->prepare($query);
            $role->bindValue('role_name', $this->role_name);

            if($role->execute()) {
                return true;
            }

            return false;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }


    }


    /**
     * @OA\Get(
     *     path="/api/roles/roles.php",
     *     summary="Method to read all the saved roles from database",
     *     tags={"Roles"},
     *     @OA\Response(response="200", description="An example resource"),
     *     @OA\Response(response="404", description="Not Found"),
     * )
     */
    public function roles() {

        try {
            $query = 'SELECT r.role_name, r.role_id, r.created_at FROM '.$this->table.' r ORDER BY r.created_at DESC';

            $roles = $this->connection->prepare($query);
            $roles->execute();

            return $roles;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }


    }


    /**
     * @OA\Get(
     *     path="/api/roles/single.php",
     *     summary="Method to read single role from database",
     *     tags={"Roles"},
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
    public function get_single_role($id) {

        try {
            $this->role_id = $id;

            $query = 'SELECT r.role_name, r.id, r.created_at FROM '.$this->table.' r WHERE r.id = :id LIMIT 0,1';

            $role = $this->connection->prepare($query);
            $role->bindValue('id', $this->role_id);

            $role->execute();

            return $role;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Put(
     *     path="/api/roles/update.php",
     *     summary="Method to update an existing role",
     *     tags={"Roles"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="id",
     *                      type="integer",
     *                  ),
     *                  @OA\Property (
     *                      property="role_name",
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
            $this->role_name = $params['role_name'];
            $this->role_id = $params['id'];

            $query = 'UPDATE ' . $this->table . ' SET role_name = :role_name WHERE id = :id';
            $role = $this->connection->prepare($query);
            $role->bindValue('id', $this->role_id);
            $role->bindValue('role_name', $this->role_name);

            if($role->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    /**
     * @OA\Delete(
     *     path="/api/roles/destroy.php",
     *     summary="Method to delete role from database",
     *     tags={"Roles"},
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="json",
     *              @OA\Schema (
     *                  @OA\Property (
     *                      property="id",
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
            $this->role_id = $id;
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
            $role = $this->connection->prepare($query);
            $role->bindValue('id', $this->role_id);

            if($role->execute()) {
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}