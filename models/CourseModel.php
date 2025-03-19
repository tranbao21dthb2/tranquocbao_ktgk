<?php
require_once '../config.php';

class CourseModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance();
    }

    public function getAllCourses() {
        $sql = "SELECT MaHP, TenHP, SoTinChi FROM HocPhan";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function registerStudentToCourse($MaSV, $MaHP) {
        $NgayDK = date('Y-m-d');

        $sql = "INSERT INTO dangky (MaSV, NgayDK) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $MaSV, $NgayDK);
        $stmt->execute();

        $MaDK = $this->conn->insert_id;

        $sql = "INSERT INTO chitietdangky (MaDK, MaHP) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $MaDK, $MaHP);
        return $stmt->execute();
    }

    public function getRegisteredCourses($MaSV) {
        $sql = "SELECT chitietdangky.MaHP, HocPhan.TenHP, HocPhan.SoTinChi FROM chitietdangky
                JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
                JOIN HocPhan ON chitietdangky.MaHP = HocPhan.MaHP
                WHERE dangky.MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function unregisterCourse($MaSV, $MaHP) {
        $sql = "DELETE chitietdangky FROM chitietdangky
                JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
                WHERE dangky.MaSV = ? AND chitietdangky.MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $MaSV, $MaHP);
        return $stmt->execute();
    }

    public function unregisterAllCourses($MaSV) {
        $sql = "DELETE chitietdangky FROM chitietdangky
                JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
                WHERE dangky.MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        return $stmt->execute();
    }

    public function getRegisteredCoursesCount($MaSV) {
        $sql = "SELECT COUNT(*) as count FROM chitietdangky
                JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
                WHERE dangky.MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['count'];
    }

    public function getTotalCredits($MaSV) {
        $sql = "SELECT SUM(HocPhan.SoTinChi) as totalCredits FROM chitietdangky
                JOIN dangky ON chitietdangky.MaDK = dangky.MaDK
                JOIN HocPhan ON chitietdangky.MaHP = HocPhan.MaHP
                WHERE dangky.MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $MaSV);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['totalCredits'];
    }
} 