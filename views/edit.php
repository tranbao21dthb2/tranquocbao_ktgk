<?php
 require_once '../controllers/StudentController.php';
$controller = new StudentController();
$student = null;

if (isset($_GET['MaSV'])) {
    $student = $controller->edit($_GET['MaSV']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->edit($_POST['MaSV']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sinh Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Sửa Sinh Viên</h1>
        <form method="post">
            <input type="hidden" name="MaSV" value="<?= $student['MaSV'] ?>">
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?= $student['HoTen'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính</label>
                <input type="text" class="form-control" id="GioiTinh" name="GioiTinh" value="<?= $student['GioiTinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?= $student['NgaySinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình</label>
                <input type="text" class="form-control" id="Hinh" name="Hinh" value="<?= $student['Hinh'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành</label>
                <input type="text" class="form-control" id="MaNganh" name="MaNganh" value="<?= $student['MaNganh'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
</body>
</html> 