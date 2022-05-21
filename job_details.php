<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/employer.php");
require_once("models/category.php");
require_once("models/job.php");

session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$job_id = "";
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
} else {
    header("location: 404.php");
}


$us = new User();
$learner = new Learner();
$job = new Job();
$emp = new Employer();
$curr_job = "";
if ($job->findJobDetailsByJobID($job_id) != null) {
    $curr_job = $job->findJobDetailsByJobID($job_id);
}
$time_ago = $job->time_elapsed_string($curr_job['created_time']);

$learner_id = "";
if ($learner->findLearnerByUserID($user_id) != false) {
    $current_learner = $learner->findLearnerByUserID($user_id);
    $learner_id = $current_learner['id'];
}

$employer = "";
if($emp->findEmployerByUserID($user_id) != null){
    $employer = $emp->findEmployerByUserID($user_id);
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #fcde67;
        }

        .noBorderRedius {
            border-radius: 0;
        }

        .noMarginPadding {
            margin: 0;
            padding: 0;
        }

        .divCenter {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>
    <div class="container">
        <div class="card ms-4 me-4 mt-3 mb-3 noBorderRedius">
            <div class="row">
                <div class="col-md-3 mt-2">
                    <div class="card noBorderRedius noMarginPadding">
                        <img src="<?php echo $curr_job['picture'] ?>" alt="" height="200px">
                    </div>
                </div>
                <div class="col-md-9 mt-2 mb-4">
                    <h2><?php echo $curr_job['title'] ?></h2>
                    <h5><?php echo $curr_job['company_name'] ?></h5>
                    <p><?php echo $curr_job['location'] ?>, <?php echo $time_ago ?> <span class="text-warning" >(<?php echo $job->findTotalJobApplicantsByJobID($curr_job['id'])?> Applicants)</span></p>
                    <hr>
                    <p><strong>Job type:</strong> <?php echo $curr_job['type'] ?></p>
                    <p><strong>Employess:</strong> <?php echo $curr_job['size'] ?> employess</p>
                    <p><strong>Industry:</strong> <?php echo $curr_job['name'] ?></p>
                    <p><strong>Schedule:</strong> <?php echo $curr_job['schedule'] ?> hour office time</p>
                    <p><strong>Salary:</strong> <?php echo $curr_job['minimum'] ?>-<?php echo $curr_job['maximum'] ?></p>
                    <p><strong>Job Opening:</strong> <?php echo $curr_job['people'] ?> peoeple</p>

                    <?php
                    if ($job->checkIfJobPostOwnsByTheCurrentUser($user_id,$curr_job['id']) == false) {
                        if ($job->checkIfAlreadyApplyToJob($job_id, $learner_id) == true) {
                    ?>
                            <div class="mt-4 mb-4">
                                <button class="btn btn-dark btn-lg btn-rounded" disabled>Applied</button>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="mt-4 mb-4">
                                <a onclick="wannaApply()" href="job_apply.php?job_id=<?php echo $curr_job['id'] ?>" class="btn btn-dark btn-lg btn-rounded">Apply</a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <hr>
                    <h5>Job description</h5>
                    <hr>
                    <p><?php echo $curr_job['description'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <?php include "utility/footer.php" ?>

    <script>
        function wannaApply() {
            alert("Do you want to apply to this job?");
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>


</html>