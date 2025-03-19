<?php
require_once '../controllers/StudentController.php';
require_once '../models/StudentModel.php';

$controller = new StudentController();
$model = new StudentModel();
$controller->create();

// Fetch the list of MaNganh from the database
$majors = $model->getAllMajors(); // Assuming this method exists in StudentModel
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Thêm Sinh Viên</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" required>
            </div>
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính</label>
                <select class="form-control" id="GioiTinh" name="GioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nu">Nữ</option>
                    <option value="Khac">Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình</label>
                <input type="file" class="form-control" id="Hinh" name="Hinh" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành</label>
                <select class="form-control" id="MaNganh" name="MaNganh" required>
                    <?php foreach ($majors as $major): ?>
                        <option value="<?= $major['MaNganh'] ?>"><?= $major['TenNganh'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
        </form>
    </div>
</body>
</html> 