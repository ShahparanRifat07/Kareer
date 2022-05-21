<?php
require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");


session_start();
$db = new Database();
$con = $db->connect_db();

if (!isset($_SESSION['LOGGEDIN'])) {
    header("location: login.php");
}

$follower_id = "";
if (isset($_SESSION['USERID'])) {
    $follower_id = $_SESSION['USERID'];
}

$user_id = "";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("location: 404.php");
}

$learner = new Learner();
$learner->followLearner($user_id,$follower_id);


?>