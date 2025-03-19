<?php
require_once '../controllers/CourseController.php';

$controller = new CourseController();
$MaSV = $_GET['MaSV'] ?? null;

if ($MaSV) {
    $controller->unregisterAllCourses($MaSV);
    echo "Xóa tất cả học phần thành công!";
}

header("Location: registered_courses.php?MaSV=" . urlencode($MaSV));
exit(); 