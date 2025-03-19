<?php
 require_once '../controllers/StudentController.php';

if (isset($_GET['MaSV'])) {
    $controller = new StudentController();
    $controller->delete($_GET['MaSV']);
}
?> 