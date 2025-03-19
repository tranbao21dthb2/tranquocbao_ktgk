<?php
require_once '../controllers/StudentController.php';
$controller = new StudentController();
$student = null;

if (isset($_GET['MaSV'])) {
    $student = $controller->edit($_GET['MaSV']);
}

$majors = $controller->getAllMajors(); // Fetch all majors for the dropdown

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->updateStudent($_POST); // Update the student with the posted data
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
            <input type="hidden" name="MaSV" value="<?= htmlspecialchars($student['MaSV']) ?>">
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?= htmlspecialchars($student['HoTen']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính</label>
                <select class="form-select" id="GioiTinh" name="GioiTinh" required>
                    <option value="Nam" <?= $student['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $student['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    <option value="Khác" <?= $student['GioiTinh'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?= htmlspecialchars($student['NgaySinh']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình</label>
                <input type="text" class="form-control" id="Hinh" name="Hinh" value="<?= htmlspecialchars($student['Hinh']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành</label>
                <select class="form-select" id="MaNganh" name="MaNganh" required>
                    <option value="">Chọn Ngành</option>
                    <?php foreach ($majors as $major): ?>
                        <option value="<?= htmlspecialchars($major['MaNganh']) ?>" <?= $student['MaNganh'] == $major['MaNganh'] ? 'selected' : '' ?>><?= htmlspecialchars($major['TenNganh']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php" class="btn btn-secondary mt-3">Quay Lại</a>
        </form>
    </div>
</body>
</html> 