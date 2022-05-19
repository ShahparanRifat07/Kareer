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
$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet">
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

        .card {
            border-radius: 0;
        }

        .noPaddingMargin {
            padding: 0;
            margin: 0;

        }

        .blackBorder {
            border: 2px solid #757575;
            border-radius: 50%;
        }

        .centerDiv {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spaceInDiv {
            display: flex;
            justify-content: space-between;
        }
        .marginCard {
            margin: 0;
            padding: 0;
            /* overflow: hidden; */
        }
    </style>
</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 mb-4">

                <div class="card">
                    <div class="row">
                        <div class="col-md-4 centerDiv">
                            <img class="blackBorder" src="https://media.vanityfair.com/photos/5d62a5ca7a1e590008d3853f/2:3/w_733,h_1100,c_limit/breaking-bad-movie-teaser.jpg" alt="" height="200px" width="200px">
                        </div>
                        <div class="col-md-8 mt-3">
                            <h2>Jesse Pinkman <span><i class="fa-solid fa-star"></i>1250</span> </h2>
                            <p>Computer Science at United International University</p>
                            <p>Dhaka, Bangladesh</p>
                            <a href="" class="btn btn-dark btn-rounded">Follow</a>
                        </div>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4>About</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <p>Jeff Weiner is the executive chairman of LinkedIn, where he continues to help LinkedIn realize its vision of creating economic opportunity for every member of the global workforce through mentorship, coaching and advising current leadership</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-briefcase"></i> Experience</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <h5>Administrative Assistant <span>(2019-2023)</span></h5>
                        <p>Samsung R&D Institute Bangladesh Ltd. - <span>Full-time</span> </p>
                        <p>Dhaka,Bangladesh</p>
                        <hr>
                    </div>
                    <div class="ms-3 me-3">
                        <h5>Administrative Assistant <span>(2019-2023)</span></h5>
                        <p>Samsung R&D Institute Bangladesh Ltd. - <span>Full-time</span> </p>
                        <p>Dhaka,Bangladesh</p>
                        <hr>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-building-columns"></i> Education</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <h5>United International University <span>(2019-2023)</span> </h5>
                        <p>Bachelor of Science and Engineering, Computer Science and Engineering</p>
                        <hr>
                    </div>
                    <div class="ms-3 me-3">
                        <h5>United International University <span>(2019-2023)</span> </h5>
                        <p>Bachelor of Science and Engineering, Computer Science and Engineering</p>
                        <hr>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-building-columns"></i> Skills</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <h6>Python</h6>
                        <hr>
                        <h6>Python</h6>
                        <hr>
                        <h6>Python</h6>
                        <hr>
                        <h6>Python</h6>
                        <hr>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-video"></i> Courses</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv">View All</a>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card marginCard">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/640px-Python-logo-notext.svg.png" alt="" height="130px">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <a href="<?php echo $row['id'] ?>" class="text-dark">
                                    <h5>Learn Python</h5>
                                </a>
                                <a href="<?php echo $employe_id ?>" class="text-dark">
                                    <p>Shahparan Rifat</p>
                                </a>
                                <p>Completed: 2019</p>
                            </div>
                            <div class="col-md-3">
                                <a href="" class="btn btn-dark btn-sm">view course</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="card">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card marginCard">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/Python-logo-notext.svg/640px-Python-logo-notext.svg.png" alt="" height="130px">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <a href="<?php echo $row['id'] ?>" class="text-dark">
                                    <h5>Learn Python</h5>
                                </a>
                                <a href="<?php echo $employe_id ?>" class="text-dark">
                                    <p>Shahparan Rifat</p>
                                </a>
                                <p>Completed: 2019</p>
                            </div>
                            <div class="col-md-3">
                                <a href="" class="btn btn-dark btn-sm">view course</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-list-check"></i> Projects</h4>
                        <a href="" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <h5>United International University <span>(2019-2023)</span> </h5>
                        <p>Bachelor of Science and Engineering, Computer Science and Engineering</p>
                        <hr>
                    </div>
                    <div class="ms-3 me-3">
                        <h5>United International University <span>(2019-2023)</span> </h5>
                        <p>Bachelor of Science and Engineering, Computer Science and Engineering</p>
                        <hr>
                    </div>
                </div>






            </div>
            <div class="col-md-4">
                <div class="card">

                </div>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>