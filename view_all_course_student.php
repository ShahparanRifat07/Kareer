<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/course.php");
require_once("models/instructor.php");

session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {

    $user_id = $_SESSION['USERID'];
}

$course_id = "";
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    header("location: 404.php");
}


$us = new User();
$learner = new Learner();
$course = new Course();
$curr_course = "";
if ($course->findCourseById($course_id) != null) {
    $curr_course = $course->findCourseById($course_id);
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
            <h1 class="ms-auto me-auto">All Students</h1>
        </div>

        <table class="table align-middle mb-0 bg-white mb-4">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT user.first_name, user.last_name,user.email,learner_profile.profile_pic, course.title, course_transaction.transaction_time,user.id,learner_id,learner_profile.user_id
                            FROM `course_transaction`
                            JOIN learner_profile
                            ON learner_profile.id = course_transaction.learner_id
                            JOIN user
                            ON user.id = learner_profile.user_id
                            JOIN course
                            ON course_transaction.course_id = course.id
                            WHERE course_transaction.course_id = '$course_id'
                            ORDER BY course_transaction.transaction_time DESC";

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

                        </tr>

                <?php
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