<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/employer.php");
require_once("models/job.php");

session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$job_id = "";
if(isset($_GET['job_id'])){
    $job_id = $_GET['job_id'];
}else{
    header("location: 404.php");
}

$learner = new Learner();
$job = new Job();
if($learner->findLearnerByUserID($user_id) != false){
    $current_learner = $learner->findLearnerByUserID($user_id);
    $job->applyToJob($job_id,$current_learner['id']);
}
