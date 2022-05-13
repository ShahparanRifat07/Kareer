<?php
require_once("models/database.php");
require_once("models/user.php");
require_once("models/course.php");
require_once("models/admin.php");


$course_id = "";
if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
}

$course = new Course();
$course->approveCourse($course_id);

?>