<?php
class Database {
    private static $instance = null;
    public $conn;

    private function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "QLSV");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
?>
