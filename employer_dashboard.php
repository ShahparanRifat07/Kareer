<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");

session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$db = new Database();
$con = $db->connect_db();
$user_id = $_SESSION['USERID'];

$emp = new Employer();

if (($emp->checkIsEmployer($user_id)) != true) {
    header("location: no_access.php");
}

$employer = $emp->findEmployerByUserID($user_id);

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
                        <a href="" class="btn btn-dark">Create a job post</a>
                    </div>

                    <div class="card mt-2 mb-2 customCard">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card marginCard">
                                        <img src="https://play-lh.googleusercontent.com/1cqAnD-lDTtohKEUE_oJ6hTubEwiXLKTjV8WCf6SJJA73d05qnvJ_HXeBvs3nQQZHj0" alt="" height="130px">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <a href="" class="text-dark">
                                        <h5>Software Engineering Internship 2022</h5>
                                    </a>
                                    <a href="" class="text-dark">
                                        <p>Cobblestone Energy</p>
                                    </a>
                                    <p>Dhaka, Dhaka, Bangladesh (On-site)</p>
                                </div>
                                <div class="col-md-3">
                                    <a href="" class="btn btn-dark btn-sm">view job Applicants</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card marginCard">
                                        <img src="https://play-lh.googleusercontent.com/1cqAnD-lDTtohKEUE_oJ6hTubEwiXLKTjV8WCf6SJJA73d05qnvJ_HXeBvs3nQQZHj0" alt="" height="130px">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <a href="" class="text-dark">
                                        <h5>Software Engineering Internship 2022</h5>
                                    </a>
                                    <a href="" class="text-dark">
                                        <p>Cobblestone Energy</p>
                                    </a>
                                    <p>Dhaka, Dhaka, Bangladesh (On-site)</p>
                                </div>
                                <div class="col-md-3">
                                    <a href="" class="btn btn-dark btn-sm">view job Applicants</a>
                                </div>
                            </div>
                        </div>
                        <hr>


                        <div class="card">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card marginCard">
                                        <img src="https://play-lh.googleusercontent.com/1cqAnD-lDTtohKEUE_oJ6hTubEwiXLKTjV8WCf6SJJA73d05qnvJ_HXeBvs3nQQZHj0" alt="" height="130px">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <a href="" class="text-dark">
                                        <h5>Software Engineering Internship 2022</h5>
                                    </a>
                                    <a href="" class="text-dark">
                                        <p>Cobblestone Energy</p>
                                    </a>
                                    <p>Dhaka, Dhaka, Bangladesh (On-site)</p>
                                </div>
                                <div class="col-md-3">
                                    <a href="" class="btn btn-dark btn-sm">view job Applicants</a>
                                </div>
                            </div>
                        </div>
                        <hr>


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