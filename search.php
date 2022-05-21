<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");
require_once("models/job.php");

session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}


$us = new User();
$cor = new Course();
$job = new Job();
$learner = new Learner();

$search_word = "";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_word = $_GET['search'];
} else {
    header("location: index.php");
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

        .imgHeight {
            border: 0.5px solid #E0E0E0;
            border-radius: 0;
            height: 180px;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>



    <section id="sec1">
        <div class="container">
            <div class="card noBorderRedius bg-dark mt-3 mb-2">
                <h1 class="text-light "> Showing results for <span class="text-warning"><?php echo $search_word ?></span> </h1>
            </div>
        </div>
    </section>

    <section id="sec2" class="mt-5">
        <div class="container ">
            <h2>Courses</h2>
            <hr>

            <div>
                <div class="row">

                    <?php

                    $query = "SELECT course.id,instructor_id,title,price,picture,user.first_name,user.last_name
                                    FROM course
                                    JOIN category
                                    ON course.category_id = category.id
                                    JOIN instructor_profile
                                    ON course.instructor_id = instructor_profile.id
                                    JOIN user
                                    ON instructor_profile.user_id = user.id
                                    WHERE course.title LIKE '%" . $search_word . "%' 
                                    OR course.description LIKE '%" . $search_word . "%'
                                    OR category.name LIKE '%" . $search_word . "%'
                                    OR category.description LIKE '%" . $search_word . "%'";

                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $is_bought = $learner->checkIfCourseBoughtByUser($row['id'], $user_id);

                    ?>
                            <div class="col-md-3">
                                <div class="card mb-3 c-full noMarginPadding">
                                    <div class="noMarginPadding bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                        <img src="<?php echo $row['picture'] ?>" class="img-fluid imgHeight" />
                                        <a href="#!">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                        </a>
                                    </div>
                                    <div class="card-body c-body">
                                        <h6 class="card-title"><?php echo $row['title'] ?></h6>
                                        <p class="card-text"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></p>
                                        <p class="card-text">Price: $<?php echo $row['price'] ?></p>
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
                    } else {
                        ?>
                        <div class="card noBorderRedius mb-3">
                            <h5>No Course Found</h5>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </section>


    <section id="sec3" class="mt-5">
        <div class="container">
            <h2>Job Posts</h2>
            <hr>

            <?php

            $query = "SELECT job.id,job.title,job.created_time,emp.company_name,job_type.type,location.location,emp.picture
                        FROM job
                        JOIN employer_profile AS emp
                        ON job.employe_id = emp.id
                        JOIN job_type
                        ON job.type = job_type.id
                        JOIN location
                        ON job.location = location.id
                        WHERE job.title LIKE '%" . $search_word . "%' 
                        OR job.description LIKE '%" . $search_word . "%'
                        OR location.location LIKE '%" . $search_word . "%'
                        OR job_type.type LIKE '%" . $search_word . "%'
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
                                    <img src="<?php echo $row['picture'] ?>" alt="" height="200px">
                                </div>
                            </div>
                            <div class="col-md-9 mt-2">
                                <a href="job_details.php?job_id=<?php echo $row['id'] ?>">
                                    <h2><?php echo $row['title'] ?></h2>
                                </a>
                                <p><?php echo $row['company_name'] ?></p>
                                <p><?php echo $row['location'] ?> <span> - (<?php echo $row['type'] ?></span>) </p>
                                <p><?php echo $time_ago ?> (1 applicant)</p>
                            </div>
                        </div>
                    </div>

            <?php
                }
            }else {
                ?>
                <div class="card noBorderRedius mb-3">
                    <h5>No Job Post Found</h5>
                </div>
            <?php
            }
            ?>
        </div>
    </section>



    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>