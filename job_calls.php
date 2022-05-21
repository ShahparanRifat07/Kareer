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


$learner = new Learner();
$job = new Job();
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
            <h1 class="ms-auto me-auto">Job Calls</h1>
        </div>

        <table class="table align-middle mb-0 bg-white mb-4">
            <thead class="bg-light">
                <tr>
                    <th>Job Titile</th>
                    <th>Company</th>
                    <th>Interview Time</th>
                    <th>Meeting Link</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT job.id as job_id,job.title,employer_profile.company_name,employer_profile.picture,employer_profile.id as employer_id,job_apply.meeting_time,job_apply.meet_link
                            FROM job_apply
                            LEFT JOIN job
                            ON job_apply.job_id = job.id
                            LEFT JOIN employer_profile
                            ON job.employe_id = employer_profile.id
                            WHERE learner_id ='$learner_id' AND job_apply.job_call = 1
                            ORDER BY job_apply.created_time DESC";

                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $row['picture'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <a href="job_details.php?job_id=<?php echo $row['job_id'] ?>" class="fw-bold mb-1"> <?php echo $row['title'] ?> </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['company_name'] ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $row['meeting_time'] ?></p>
                            </td>

                            <td>
                                <a href="<?php echo $row['meet_link']?>" class="fw-normal mb-1">meeting_link</a>
                            </td>
                            

                        </tr>

                <?php
                    }
                }
                ?>

            </tbody>
        </table>




    </div>

    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>