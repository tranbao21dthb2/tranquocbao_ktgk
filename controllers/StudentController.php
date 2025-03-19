<?php
require_once '../models/StudentModel.php';
class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $MaSV = $_POST['MaSV'];
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $MaNganh = $_POST['MaNganh'];

            // Handle file upload
            $targetDir = "../img/";
            $targetFile = $targetDir . basename($_FILES["Hinh"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["Hinh"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["Hinh"]["size"] > 2000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["Hinh"]["name"])) . " has been uploaded.";
                    $Hinh = $targetFile; // Save the path to the image
                    if ($this->model->addStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)) {
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "Lỗi khi thêm sinh viên.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    public function index() {
        return $this->model->getAllStudents();
    }

    public function delete($MaSV) {
        if ($this->model->deleteStudent($MaSV)) {
            header("Location: index.php");
            exit();
        } else {
            echo "Lỗi khi xóa sinh viên.";
        }
    }

    public function edit($MaSV) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $HoTen = $_POST['HoTen'];
            $GioiTinh = $_POST['GioiTinh'];
            $NgaySinh = $_POST['NgaySinh'];
            $Hinh = $_POST['Hinh'];
            $MaNganh = $_POST['MaNganh'];

            if ($this->model->updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật sinh viên.";
            }
        } else {
            return $this->model->getStudentById($MaSV);
        }
    }

    public function getStudentDetails($MaSV) {
        return $this->model->getStudentById($MaSV);
    }

    public function getStudentByMaSV($MaSV) {
        return $this->model->getStudentByMaSV($MaSV);
    }

    public function getAllMajors() {
        return $this->model->getAllMajors();
    }

    public function updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->model->updateStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }

    public function createStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh) {
        return $this->model->insertStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $Hinh, $MaNganh);
    }
}
?>