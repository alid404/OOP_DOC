<?php
require 'connection.php';

class DynamicCRUD {
    private $db;

    public function __construct() {
        $this->db = DataBase::getInstance()->getConnection();
    }

    public function read($table, $conditions = []) {
        $sql = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $filters = [];
            foreach ($conditions as $key => $value) {
                $filters[] = "$key = :$key";
            }
            $sql .= " WHERE " . implode(" AND ", $filters);
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll();
    }

    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
    }

    public function update($table, $data, $conditions) {
        $updates = [];
        foreach ($data as $key => $value) {
            $updates[] = "$key = :$key";
        }
        $filters = [];
        foreach ($conditions as $key => $value) {
            $filters[] = "$key = :where_$key";
        }
        $sql = "UPDATE $table SET " . implode(", ", $updates) . " WHERE " . implode(" AND ", $filters);
        $stmt = $this->db->prepare($sql);
        foreach ($conditions as $key => $value) {
            $data["where_$key"] = $value;
        }
        $stmt->execute($data);
    }

    public function delete($table, $conditions) {
        $filters = [];
        foreach ($conditions as $key => $value) {
            $filters[] = "$key = :$key";
        }
        $sql = "DELETE FROM $table WHERE " . implode(" AND ", $filters);
        $stmt = $this->db->prepare($sql);
        $stmt->execute($conditions);
    }
}
?>
