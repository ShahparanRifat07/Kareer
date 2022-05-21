<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/category.php");
require_once("models/job.php");

session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}


$us = new User();
$learner = new Learner();
$job = new Job();



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

        <?php

        $query = "SELECT job.id,job.title,job.created_time,emp.company_name,job_type.type,location.location,emp.picture
                    FROM job
                    JOIN employer_profile AS emp
                    ON job.employe_id = emp.id
                    JOIN job_type
                    ON job.type = job_type.id
                    JOIN location
                    ON job.location = location.id
                    ORDER BY job.created_time DESC";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $time_ago = $job->time_elapsed_string($row['created_time']);

        ?>
                <div class="card ms-4 me-4 mt-3 mb-3 noBorderRedius">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card noBorderRedius noMarginPadding">
                                <img src="<?php echo $row['picture']?>" alt="" height="200px">
                            </div>
                        </div>
                        <div class="col-md-9 mt-2">
                            <a href="job_details.php?job_id=<?php echo $row['id'] ?>">
                                <h2><?php echo $row['title']?></h2>
                            </a>
                            <p><?php echo $row['company_name']?></p>
                            <p><?php echo $row['location']?> <span> - (<?php echo $row['type']?></span>) </p>
                            <p><?php echo $time_ago ?> <span class="text-warning" >(<?php echo $job->findTotalJobApplicantsByJobID($row['id'])?> Applicants)</span> </p>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>




    </div>

    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>