<?php
session_start();
require_once '../controllers/StudentController.php';
require_once '../controllers/CourseController.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$studentController = new StudentController();
$student = $studentController->getStudentByMaSV($MaSV);

$courseController = new CourseController();
$courses = $courseController->getAllCourses();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaHP'])) {
    $MaHP = $_POST['MaHP'];
    $courseController->registerCourse($MaSV, $MaHP);
    $successMessage = "Đăng ký học phần thành công!";
}

if (!$student) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .student-image {
            max-width: 150px; /* Adjust the size as needed */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Chi Tiết Sinh Viên</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($student['HoTen']) ?></h5>
                <p class="card-text"><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
                <p class="card-text"><strong>Giới Tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
                <p class="card-text"><strong>Ngày Sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
                <p class="card-text"><strong>Mã Ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
                <img src="<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình ảnh" class="img-fluid student-image">
            </div>
        </div>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <h2 class="mb-4">Đăng Ký Học Phần</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã Học Phần</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['MaHP']) ?></td>
                        <td><?= htmlspecialchars($course['TenHP']) ?></td>
                        <td><?= htmlspecialchars($course['SoTinChi']) ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="MaHP" value="<?= htmlspecialchars($course['MaHP']) ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Đăng Ký</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="registered_courses.php" class="btn btn-info mt-3">Xem Học Phần Đã Đăng Ký</a>
        <a href="logout.php" class="btn btn-secondary mt-3">Đăng Xuất</a>
    </div>
</body>
</html> 