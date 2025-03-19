<?php
require_once '../models/CourseModel.php';

class CourseController {
    private $model;

    public function __construct() {
        $this->model = new CourseModel();
    }

    public function getAllCourses() {
        return $this->model->getAllCourses();
    }

    public function registerCourse($MaSV, $MaHP) {
        return $this->model->registerStudentToCourse($MaSV, $MaHP);
    }

    public function getRegisteredCourses($MaSV) {
        return $this->model->getRegisteredCourses($MaSV);
    }

    public function unregisterCourse($MaSV, $MaHP) {
        return $this->model->unregisterCourse($MaSV, $MaHP);
    }

    public function unregisterAllCourses($MaSV) {
        return $this->model->unregisterAllCourses($MaSV);
    }

    public function getRegisteredCoursesCount($MaSV) {
        return $this->model->getRegisteredCoursesCount($MaSV);
    }

    public function getTotalCredits($MaSV) {
        return $this->model->getTotalCredits($MaSV);
    }
} 