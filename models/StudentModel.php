<?php
require_once __DIR__ . '/../config.php';
class StudentModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function addStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
        return $stmt->execute();
    }

    public function getAllStudents() {
        $sql = "SELECT * FROM SinhVien";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteStudent($MaSV) {
        $sql = "DELETE FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        return $stmt->execute();
    }

    public function updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        $sql = "UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh, $MaSV);
        return $stmt->execute();
    }

    public function getStudentById($MaSV) {
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getStudentByMaSV($MaSV) {
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>