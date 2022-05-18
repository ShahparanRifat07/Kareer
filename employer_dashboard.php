<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");
require_once("models/job.php");

session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$db = new Database();
$con = $db->connect_db();
$user_id = $_SESSION['USERID'];

$emp = new Employer();
$job = new Job();

if (($emp->checkIsEmployer($user_id)) != true) {
    header("location: no_access.php");
}

$employer = $emp->findEmployerByUserID($user_id);

$employe_id = $employer['id'];
$company_name = $employer['company_name'];
$description = $employer['description'];
$picture = $employer['picture'];
$industry_name = $employer['industry_name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profile.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <title>Document</title>

    <style>
        body {
            background-color: #fcde67;
        }

        #company_logo {
            margin: 0;
            padding: 0;
        }

        .customCard {
            border-radius: 0;
        }

        .marginCard {
            margin: 0;
            padding: 0;
            /* overflow: hidden; */
        }
    </style>
</head>

<body>
    <?php include "utility/employer_navbar.php" ?>

    <div class="container">
        <div class="card mt-4 customCard">
            <div class="row">
                <div class="col-md-3">
                    <div id="company_logo" class="card mb-2 mt-2">
                        <img src="<?php echo $picture ?>" alt="" height="200px">
                    </div>
                </div>
                <div class="col-md-9 mb-2 mt-2">
                    <h4><?php echo $company_name ?></h4>
                    <p><strong><?php echo $industry_name ?></strong></p>
                    <p><?php echo $description ?></p>

                    <a href="" class="btn btn-dark">View Profile</a>
                    <a href="" class="btn btn-dark">Edit Profile</a>
                </div>
            </div>
        </div>


        <div>
            <div class="row">
                <div class="col-md-3 ">
                    <div class="card mt-4 bg-dark text-light mb-4 customCard">
                        <h3>Ananlytics</h3>
                        <hr>
                        <div>
                            <h4>30</h4>
                            <p>job posts</p>
                        </div>
                        <hr>
                        <div>
                            <h4>1200</h4>
                            <p>Total Applicants</p>
                        </div>
                        <hr>
                        <div>
                            <h4>750</h4>
                            <p>Followers</p>
                        </div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="card mt-4 mb-4">
                        <a href="create_job.php" class="btn btn-dark">Create a job post</a>
                    </div>

                    <div class="card mt-2 mb-2 customCard">

                        <?php

                        $query = "SELECT * FROM job WHERE employe_id = '$employe_id'";
                        $result = mysqli_query($con, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $location = $job->findLocationById($row['location']);
                                $type = $job->findJobTypeById($row['type']);

                        ?>

                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="card marginCard">
                                                <img src="<?php echo $picture ?>" alt="" height="130px">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <a href="<?php echo $row['id'] ?>" class="text-dark">
                                                <h5><?php echo $row['title'] ?></h5>
                                            </a>
                                            <a href="<?php echo $employe_id ?>" class="text-dark">
                                                <p><?php echo $company_name ?></p>
                                            </a>
                                            <p><?php echo $location['location'] ?> (<?php echo $type['type'] ?>)</p>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="" class="btn btn-dark btn-sm">view job Applicants</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>

                            <?php
                            }
                        } else {
                            ?>
                            <h3>No Job Posts</h3>
                        <?php
                        }

                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>