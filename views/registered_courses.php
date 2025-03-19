<?php
session_start();
require_once '../controllers/CourseController.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];
$courseController = new CourseController();
$registeredCourses = $courseController->getRegisteredCourses($MaSV);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_selected'])) {
        if (!empty($_POST['selected_courses'])) {
            foreach ($_POST['selected_courses'] as $MaHP) {
                $courseController->unregisterCourse($MaSV, $MaHP);
            }
            $successMessage = "Đã xóa các học phần đã chọn.";
        }
    } elseif (isset($_POST['delete_all'])) {
        $courseController->unregisterAllCourses($MaSV);
        $successMessage = "Đã xóa tất cả các học phần.";
    }
    $registeredCourses = $courseController->getRegisteredCourses($MaSV);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Phần Đã Đăng Ký</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Học Phần Đã Đăng Ký</h1>

        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>

        <form method="post">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Chọn</th>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registeredCourses as $course): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_courses[]" value="<?= htmlspecialchars($course['MaHP']) ?>">
                            </td>
                            <td><?= htmlspecialchars($course['MaHP']) ?></td>
                            <td><?= htmlspecialchars($course['TenHP']) ?></td>
                            <td><?= htmlspecialchars($course['SoTinChi']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="delete_selected" class="btn btn-danger">Xóa Học Phần Đã Chọn</button>
            <button type="submit" name="delete_all" class="btn btn-warning">Xóa Tất Cả Học Phần</button>
        </form>

        <a href="student_info.php" class="btn btn-secondary mt-3">Quay Lại</a>
    </div>
</body>
</html> 