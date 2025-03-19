<?php
session_start();
require_once '../controllers/StudentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $MaSV = $_POST['MaSV'] ?? null;

    if ($MaSV) {
        if ($MaSV === 'admin') {
            $_SESSION['role'] = 'admin';
            header("Location: index.php");
            exit();
        }

        $studentController = new StudentController();
        $student = $studentController->getStudentByMaSV($MaSV);

        if ($student) {
            $_SESSION['MaSV'] = $MaSV;
            header("Location: student_info.php");
            exit();
        } else {
            $error = "MSSV không tồn tại.";
        }
    } else {
        $error = "Vui lòng nhập MSSV.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">ĐĂNG NHẬP</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã SV</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" value="<?= htmlspecialchars($MaSV ?? '') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>
    </div>
</body>
</html> 