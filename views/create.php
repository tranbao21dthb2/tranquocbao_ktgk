<?php
session_start();
require_once '../controllers/StudentController.php';

$controller = new StudentController();
$majors = $controller->getAllMajors(); // Fetch all majors for the dropdown

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_FILES['Hinh']['name']; // Get the image name
    $MaNganh = $_POST['MaNganh'];

    // Handle file upload
    $targetDir = "../img/";
    $targetFile = $targetDir . basename($Hinh);
    move_uploaded_file($_FILES['Hinh']['tmp_name'], $targetFile); // Move the uploaded file

    // Call the controller to create a new student
    $controller->createStudent($MaSV, $HoTen, $GioiTinh, $NgaySinh, $targetFile, $MaNganh);
    $successMessage = "Thêm sinh viên thành công!";
}
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
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($successMessage) ?></div>
        <?php endif; ?>
        <form method="post" action="" enctype="multipart/form-data">
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
                <select class="form-select" id="GioiTinh" name="GioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình</label>
                <input type="file" class="form-control" id="Hinh" name="Hinh" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành</label>
                <select class="form-select" id="MaNganh" name="MaNganh" required>
                    <option value="">Chọn Ngành</option>
                    <?php foreach ($majors as $major): ?>
                        <option value="<?= htmlspecialchars($major['MaNganh']) ?>"><?= htmlspecialchars($major['TenNganh']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
            <a href="index.php" class="btn btn-secondary mt-3">Quay Lại</a>
        </form>
    </div>
</body>
</html> 