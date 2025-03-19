<?php
session_start();
require_once '../controllers/StudentController.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$controller = new StudentController();
$students = $controller->index();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Danh Sách Sinh Viên</h1>
        <a href="create.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình</th>
                    <th>Mã Ngành</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= htmlspecialchars($student['MaSV']) ?></td>
                        <td><?= htmlspecialchars($student['HoTen']) ?></td>
                        <td><?= htmlspecialchars($student['GioiTinh']) ?></td>
                        <td><?= htmlspecialchars($student['NgaySinh']) ?></td>
                        <td><img src="<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình ảnh" width="50"></td>
                        <td><?= htmlspecialchars($student['MaNganh']) ?></td>
                        <td>
                            <a href="edit.php?MaSV=<?= urlencode($student['MaSV']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="delete.php?MaSV=<?= urlencode($student['MaSV']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                            <a href="view.php?MaSV=<?= urlencode($student['MaSV']) ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a>
                            <!-- <a href="register_course.php?MaSV=<?= urlencode($student['MaSV']) ?>" class="btn btn-secondary btn-sm">Đăng Ký Học Phần</a> -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>