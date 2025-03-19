<?php
session_start();
require_once '../controllers/CourseController.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$controller = new CourseController();
$courses = $controller->getAllCourses();
$MaSV = $_SESSION['MaSV'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['MaHP'])) {
    $MaHP = $_POST['MaHP'];
    $controller->registerCourse($MaSV, $MaHP);
    echo "Đăng ký thành công!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Danh Sách Học Phần</h1>
        <a href="logout.php" class="btn btn-secondary mb-3">Đăng Xuất</a>
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
        <a href="index.php" class="btn btn-secondary mt-3">Quay Lại</a>
    </div>
</body>
</html> 