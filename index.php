<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");

session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}


$us = new User();
$cor = new Course();
$ins = new Instructor();
$learner = new Learner();



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

        #section2>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        #section2>div:nth-of-type(1) a {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: underline;
        }

        #section3>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        #section3>div:nth-of-type(1) a {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30px;
            /* text-decoration: underline; */
        }


        #section4>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        #section4>div:nth-of-type(1) a {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30px;
            /* text-decoration: underline; */
        }


        #section5>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        #section5>div:nth-of-type(1) a {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 30px;
            /* text-decoration: underline; */
        }



        .c-full {
            padding: 5px;
            /* border-radius: 0; */
        }

        .c-full>div:nth-of-type(1)>img {
            border: 0.5px solid #E0E0E0;
            border-radius: 0;
            height: 180px;
            object-fit: cover;
        }

        .c-body {
            height: 140px;
            padding: 7px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .c-body>h6 {
            font-weight: 500;
            padding: 0;
        }

        .c-body>p {
            font-weight: 200;
            font-size: 13px;
            margin: 0;
            margin-top: 4px;
            margin-bottom: 4px;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div class="container">

        <?php include "utility/slider.php" ?>

        <?php
        if (isset($_SESSION['LOGGEDIN'])) {
            $is_bought = $learner->checkIfAnyCourseBought($user_id);
            if ($is_bought == true) {
                $user = $us->findUserByUserId($user_id);

        ?>

                <div id="section2">
                    <div class="mt-5 mb-3">
                        <h2>Let's start learning, <?php echo $user['last_name']  ?></h2>
                        <a href="" class="text-dark">My learning</a>
                    </div>
                    <div>
                        <div class="row">
                            <?php
                            $learner1 = $learner->findLearnerByUserID($user_id);
                            $learner_id = $learner1['id'];
                            $query1 = "SELECT * FROM course_transaction AS ct JOIN course AS co ON ct.course_id = co.id WHERE ct.learner_id = '$learner_id' ORDER BY ct.transaction_time DESC LIMIT 4";
                            $result1 = mysqli_query($con, $query1);

                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    $cur_instructor = $ins->findInstructorByInstructorID($row['instructor_id']);
                            ?>
                                    <div class="col-md-3">
                                        <div class="card mb-3 c-full">
                                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                                <img src="<?php echo $row['picture'] ?>" class="img-fluid" />
                                                <a href="course_details.php?id=<?php echo $row['id'] ?>">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                                </a>
                                            </div>
                                            <div class="card-body c-body">
                                                <h6 class="card-title"><a class="text-dark" href="course_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></h6>
                                                <p class="card-text"><?php echo $cur_instructor['instructor_name'] ?></p>
                                                <p class="card-text">Price: $<?php echo $row['price'] ?></p>
                                                <a href="course_details.php?id=<?php echo $row['id'] ?>" class="d-flex justify-content-center btn btn-light btn-sm">Learn</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            }

                            ?>
                        </div>
                    </div>
                </div>
        <?php

            }
        }
        ?>






        <div id="section3">
            <div class="mt-5 mb-3">
                <h2>Newest Courses</h2>
                <a href="" class="btn btn-dark btn-sm">View All</a>
            </div>
            <div>
                <div class="row">
                    <?php

                    $query = "SELECT * FROM course WHERE is_approved = true ORDER BY created_time DESC  LIMIT 4";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $instructor = $ins->findInstructorByInstructorID($row['instructor_id']);
                            $is_bought = $learner->checkIfCourseBoughtByUser($row['id'], $user_id);
                    ?>
                            <div class="col-md-3">
                                <div class="card mb-3 c-full">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <img src="<?php echo $row['picture'] ?>" class="img-fluid" />
                                        <a href="course_details.php?id=<?php echo $row['id'] ?>">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                        </a>

                                    </div>
                                    <div class="card-body c-body">
                                        <h6 class="card-title"><a class="text-dark" href="course_details.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></h6>
                                        <p class="card-text"><?php echo $instructor['instructor_name'] ?></p>
                                        <p class="card-text"> <strong>Price:</strong> $<?php echo $row['price'] ?></p>
                                        <?php
                                        if ($is_bought == false) {
                                        ?>
                                            <a href="course_checkout.php?course_id=<?php echo $row['id'] ?>" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="course_details.php?id=<?php echo $row['id'] ?>" class="d-flex justify-content-center btn btn-light btn-sm">Learn</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>















        <div id="section4">
            <div class="mt-5 mb-3">
                <h2>Most Viewed Courses</h2>
                <a href="" class="btn btn-dark btn-sm">View All</a>
            </div>
            <div>
                <div class="row">

                    <?php

                    $query2 = "SELECT COUNT(cv.id) AS view, course_id, co.title,co.price,co.is_approved,co.picture,ins.instructor_name FROM course_view as cv JOIN course as co ON cv.course_id = co.id JOIN instructor_profile as ins ON co.instructor_id = ins.id WHERE co.is_approved=true GROUP BY cv.course_id ORDER BY view DESC LIMIT 4;";
                    $result2 = mysqli_query($con, $query2);
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $is_bought2 = $learner->checkIfCourseBoughtByUser($row2['course_id'], $user_id);
                    ?>
                            <div class="col-md-3">
                                <div class="card mb-3 c-full">
                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <img src="<?php echo $row2['picture'] ?>" class="img-fluid" />
                                        <a href="course_details.php?id=<?php echo $row2['course_id'] ?>">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                        </a>
                                    </div>
                                    <div class="card-body c-body">
                                        <h6 class="card-title"><a class="text-dark" href="course_details.php?id=<?php echo $row2['course_id'] ?>"><?php echo $row2['title'] ?></a></h6>
                                        <p class="card-text"><?php echo $row2['instructor_name'] ?></p>
                                        <p class="card-text">Price: $<?php echo $row2['price'] ?></p>
                                        <?php
                                        if ($is_bought2 == false) {
                                        ?>
                                            <a href="course_checkout.php?course_id=<?php echo $row2['course_id'] ?>" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="course_details.php?id=<?php echo $row2['course_id'] ?>" class="d-flex justify-content-center btn btn-light btn-sm">Learn</a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>











        <div id="section5">
            <div class="mt-5 mb-3">
                <h2>Top Rated Courses</h2>
                <a href="" class="btn btn-dark btn-sm">View All</a>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card mb-3 c-full">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://www.softwaretestinghelp.com/wp-content/qa/uploads/2020/12/Python-Programming.png" class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body c-body">
                                <h6 class="card-title">Learn Python</h6>
                                <p class="card-text">Shahparn Rifat</p>
                                <p class="card-text">Price: $18</p>
                                <a href="#!" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3 c-full">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://www.softwaretestinghelp.com/wp-content/qa/uploads/2020/12/Python-Programming.png" class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body c-body">
                                <h6 class="card-title">Learn Python</h6>
                                <p class="card-text">Shahparn Rifat</p>
                                <p class="card-text">Price: $18</p>
                                <a href="#!" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3 c-full">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://www.softwaretestinghelp.com/wp-content/qa/uploads/2020/12/Python-Programming.png" class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body c-body">
                                <h6 class="card-title">Learn Python</h6>
                                <p class="card-text">Shahparn Rifat</p>
                                <p class="card-text">Price: $18</p>
                                <a href="#!" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card mb-3 c-full">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="https://www.softwaretestinghelp.com/wp-content/qa/uploads/2020/12/Python-Programming.png" class="img-fluid" />
                                <a href="#!">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                </a>
                            </div>
                            <div class="card-body c-body">
                                <h6 class="card-title">Learn Python</h6>
                                <p class="card-text">Shahparn Rifat</p>
                                <p class="card-text">Price: $18</p>
                                <a href="#!" class="d-flex justify-content-center btn btn-dark btn-sm">Enroll</a>
                            </div>
                        </div>
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