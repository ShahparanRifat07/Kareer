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

        <div class="card mt-3 mb-3 noBorderRedius text-light bg-dark">
            <h1 class="ms-auto me-auto">Job Applicants</h1>
        </div>

        <table class="table align-middle mb-0 bg-white mb-4">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>View</th>
                    <th>Call</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT learner_profile.profile_pic,learner_profile.id,learner_profile.user_id,user.first_name,user.last_name,user.email, job_apply.created_time
                            FROM job_apply
                            JOIN learner_profile
                            ON job_apply.learner_id = learner_profile.id
                            JOIN user
                            ON learner_profile.user_id = user.id
                            WHERE job_apply.job_id = '$job_id'
                            ORDER BY created_time DESC;";

                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $rank = 1;
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $row['profile_pic'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <a href="profile.php?user_id=<?php echo $row['user_id'] ?>" class="fw-bold mb-1"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['email'] ?></p>
                            </td>
                            <td>
                                <a href="profile.php?user_id=<?php echo $row['user_id'] ?>" class="btn btn-primary btn-sm btn-rounded">view</a>
                            </td>
                            <?php
                            if ($job->checkIfLearnerIsCalled($row['id'], $job_id) == false) {
                            ?>
                                <td>
                                    <a href="call_for_job.php?learner_id=<?php echo $row['id'] ?>&job_id=<?php echo $job_id ?>" type="button" class="btn btn-success btn-sm btn-rounded">
                                        Call
                                    </a>
                                </td>
                            <?php
                            } else {
                            ?>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-rounded" disabled>
                                        Called
                                    </button>
                                </td>
                            <?php
                            }
                            ?>

                        </tr>

                <?php
                        $rank = $rank + 1;
                    }
                }
                ?>

            </tbody>
        </table>





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