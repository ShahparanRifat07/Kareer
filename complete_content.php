<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/course.php");

session_start();
if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$course_id = "";
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    header("location: 404.php");
}

$section_id = "";
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];
} else {
    header("location: 404.php");
}

$content_id = "";
if (isset($_GET['content_id'])) {
    $content_id = $_GET['content_id'];
} else {
    header("location: 404.php");
}

$user_id = "";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("location: 404.php");
}

// echo $user_id."------   ".$course_id."+++++  ".$section_id." =====  ".$content_id;
$cor = new Course();

if($cor->completeCourseContent($content_id,$user_id) == true){
    header("location:course_content.php?course_id=$course_id&section_id=$section_id&content_id=$content_id");
}



?>