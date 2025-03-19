<?php
require_once '../controllers/CourseController.php';

$controller = new CourseController();
$MaSV = $_GET['MaSV'] ?? null;
$MaHP = $_GET['MaHP'] ?? null;

if ($MaSV && $MaHP) {
    $controller->unregisterCourse($MaSV, $MaHP);
    echo "Xóa học phần thành công!";
}

header("Location: registered_courses.php?MaSV=" . urlencode($MaSV));
exit();

?>

<a href="unregister_all.php?MaSV=<?= urlencode($MaSV) ?>" class="btn btn-danger mt-3">Xóa Tất Cả</a> 