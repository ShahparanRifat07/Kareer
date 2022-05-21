<?php
require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/course.php");


session_start();
$db = new Database();
$con = $db->connect_db();

if (!isset($_SESSION['LOGGEDIN'])) {
    header("location: login.php");
}

$course_id = "";
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    header("location: 404.php");
}

$learner_id = "";
if (isset($_GET['learner_id'])) {
    $learner_id = $_GET['learner_id'];
} else {
    header("location: 404.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo $course_id."----".$learner_id;
    $course = new Course();
    $course->rateCourse($_POST,$course_id,$learner_id);
}



?>