<?php
namespace Src\TableGateways;

use PDO;
use PDOException;

class UserGateway{

    private $db = null;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findAll(){
        $statement = "
            SELECT 
                id, username, longitude, latitude, timestamp
            FROM
                users;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id) {
        $statement = "
            SELECT 
                id, username, longitude, latitude, timestamp
            FROM
                users
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $input) {
        $statement = "
            INSERT INTO users
                (username, latitude, longitude, timestamp)
            VALUES 
                (:username, :latitude, :longitude, :timestamp);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'username' => $input['username'],
                'latitude' => $input['latitude'],
                'longitude' => $input['longitude'],
                'timestamp' => $input['timestamp'] ?? 'CURRENT_TIMESTAMP',
                ));
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($id, Array $input) {
        $statement = "
            UPDATE users
            SET 
                username = :username,
                latitude  = :latitude,
                longitude = :longitude,
                timestamp = :timestamp
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id' => (int) $id,
                'username' => $input['username'],
                'latitude'  => $input['latitude'],
                'longitude' => $input['longitude'],
                'timestamp' => $input['timestamp'] ?? 'CURRENT_TIMESTAMP',
            ));
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id) {
        $statement = "
            DELETE FROM users
            WHERE id = :id;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('id' => $id));
            return $statement->rowCount();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}