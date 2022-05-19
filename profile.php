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

$db = new Database();
$con = $db->connect_db();
$id = "";
if (isset($_SESSION['USERID'])) {
    $id = $_SESSION['USERID'];
}

$user_id = "";
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    header("location: 404.php");
}

$user = new User();
$current_user = $user->findUserByUserId($user_id);
if ($current_user == null) {
    header("location: 404.php");
}
$learner = new Learner();
$current_learner = $learner->findLearnerByUserID($user_id);

$current_user_education = $user->findEducation($user_id);

$user_degree = "";
if (isset($current_user_education['degree'])) {
    $user_degree = $current_user_education['degree'];
}
$user_school = "";
if (isset($current_user_education['school'])) {
    $user_school = $current_user_education['school'];
}

$total_points = $learner->findTotalPointsOfLearner($current_learner['id']);

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
                            <img class="blackBorder" src="<?php echo $current_learner['profile_pic'] ?>" alt="" height="200px" width="200px">
                        </div>
                        <div class="col-md-8 mt-3">
                            <h2><?php echo $current_user['first_name'] ?> <?php echo $current_user['last_name'] ?> <span><i class="fa-solid fa-star"></i><?php echo $total_points['total_point'] ?></span> </h2>
                            <?php
                            if (!empty($user_degree) && !empty($user_school)) {
                            ?>
                                <p><?php echo $user_degree ?> at <?php echo $user_school ?></p>
                            <?php
                            }
                            ?>

                            <?php
                            if (!empty($current_learner['city']) && !empty($current_learner['country'])) {
                            ?>
                                <p><?php echo $current_learner['city'] ?>, <?php echo $current_learner['country'] ?></p>
                            <?php
                            }
                            ?>
                            <a href="" class="btn btn-dark btn-rounded">Follow</a>
                        </div>
                    </div>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4>About</h4>
                        <?php
                        if ($id == $user_id) {
                        ?>
                            <a href="add_about.php" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-pen-to-square"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="ms-3 me-3">
                        <p><?php echo $current_learner['biography'] ?></p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-briefcase"></i> Experience</h4>
                        <?php
                        if ($id == $user_id) {
                        ?>
                            <a href="add_experience.php?user_id=<?php echo $user_id ?>" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM experience WHERE user_id='$user_id' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="ms-3 me-3">
                                <div class="spaceInDiv">
                                    <h5><?php echo $row['job_title'] ?> <span>(<?php echo $row['start_time'] ?>-<?php echo $row['end_time'] ?>)</span> </h5>
                                    <!-- <a href="" class="btn btn-warning btn-sm">Edit</a> -->
                                </div>
                                <p><?php echo $row['company_name'] ?>. - <span><?php echo $row['job_type'] ?></span></p>
                                <p><?php echo $row['location'] ?></p>
                                <hr>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="ms-3 me-3">
                            <h5>No Experience Info</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-building-columns"></i> Education</h4>
                        <?php
                        if ($id == $user_id) {
                        ?>
                            <a href="add_education.php" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM education WHERE user_id='$user_id' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="ms-3 me-3">
                                <div class="spaceInDiv">
                                    <h5><?php echo $row['school'] ?> <span>(<?php echo $row['start_time'] ?>-<?php echo $row['end_time'] ?>)</span> </h5>
                                    <!-- <a href="" class="btn btn-warning btn-sm">Edit</a> -->
                                </div>
                                <p><?php echo $row['degree'] ?>, <?php echo $row['field'] ?></p>
                                <hr>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="ms-3 me-3">
                            <h5>No Education Info</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-building-columns"></i> Skills</h4>
                        <?php
                        if ($id == $user_id) {
                        ?>
                            <a href="add_skills.php" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>

                    <?php
                    $query = "SELECT * FROM skill WHERE user_id='$user_id' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="ms-3 me-3">
                                <h6><?php echo $row['skill'] ?> </h6>
                                <hr>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="ms-3 me-3">
                            <h5>No Skills Info</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>


                <div class="card mt-3">
                    <div class="spaceInDiv">
                        <h4><i class="fa-solid fa-video"></i> Completed Courses</h4>
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
                        <?php
                        if ($id == $user_id) {
                        ?>
                            <a href="add_project.php" class="btn btn-dark btn-sm centerDiv"><i class="fa-solid fa-plus"></i></a>
                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM project WHERE user_id='$user_id' ORDER BY id DESC";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="ms-3 me-3">
                                <h5><a href="<?php echo $row['url'] ?>"><?php echo $row['name'] ?></a> <span>(<?php echo $row['start_time'] ?>-<?php echo $row['end_time'] ?>)</span> </h5>
                                <p><?php echo $row['about'] ?></p>
                                <hr>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="ms-3 me-3">
                            <h5>No Projects</h5>
                        </div>
                    <?php
                    }
                    ?>
                </div>






            </div>
            <div class="col-md-4">
                <?php
                if ($id == $user_id) {
                ?>
                    <div class="card">
                        <a href="change_profile_pic.php" class="btn btn-dark">Change Profile Photo</a>
                        <!-- <a href="" class="btn btn-dark mt-2">Change City and Location</a> -->
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>