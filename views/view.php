<?php
require_once '../controllers/StudentController.php';

$controller = new StudentController();
$student = null;

if (isset($_GET['MaSV'])) {
    $student = $controller->getStudentDetails($_GET['MaSV']);
}

if (!$student) {
    echo "Không tìm thấy sinh viên.";
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
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Chi Tiết Sinh Viên</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $student['HoTen'] ?></h5>
                <p class="card-text"><strong>Mã SV:</strong> <?= $student['MaSV'] ?></p>
                <p class="card-text"><strong>Giới Tính:</strong> <?= $student['GioiTinh'] ?></p>
                <p class="card-text"><strong>Ngày Sinh:</strong> <?= $student['NgaySinh'] ?></p>
                <p class="card-text"><strong>Mã Ngành:</strong> <?= $student['MaNganh'] ?></p>
                <img src="<?= $student['Hinh'] ?>" alt="Hình ảnh" class="img-fluid">
            </div>
        </div>
        <a href="index.php" class="btn btn-secondary mt-3">Quay Lại</a>
    </div>
</body>
</html> 