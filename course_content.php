<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");


session_start();
// if ($_SESSION['LOGGEDIN'] != true) {
//     header('location: login.php');
// }

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$db = new Database();
$con = $db->connect_db();

$course_id = "";
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];
} else {
    header("location: 404.php");
}

$section_id = "";
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];
} else {
    header("location: 404.php");
}

$content_id = "";
if (isset($_GET['content_id'])) {
    $content_id = $_GET['content_id'];
} else {
    header("location: 404.php");
}


$learner = new Learner();
$is_brought = $learner->checkIfCourseBoughtByUser($course_id, $user_id);
$user = new User();
$is_admin = $user->checkIFAdmin($user_id);

$ins = new Instructor();
$instructor = $ins->findInstructor($user_id);
$course = new Course();
$is_course_by_instructor = "";

$is_preview = "";
if ($course->isPreviewActive($content_id) !== null) {
    $is_preview = $course->isPreviewActive($content_id);
}


if (isset($instructor)) {
    if ($course->isCourseByInstructorId($instructor['id'], $course_id) !== null) {
        $is_course_by_instructor = $course->isCourseByInstructorId($instructor['id'], $course_id);
    }
}

function relax()
{;
}

if ($is_brought == true || $is_admin == true || $is_course_by_instructor == true || $is_preview == true) {
    relax();
} else {
    header("location: no_access.php");
}


// echo $course_id."   ".$section_id."      ".$content_id;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/instructor_dashboard.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />


    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #fcde67;
        }

        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>

    <?php
    if (!empty($instructor_id)) {
        include "utility/instructor_navbar.php";
    } else {
        include "utility/navbar.php";
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card bg-dark">
                    <?php
                    $query = "SELECT * FROM section WHERE course_id = '$course_id'";
                    $result = $con->query($query);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                            <div class="mb-0">
                                <h5 class="text-light"><?php echo $row['name'] ?></h5>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <ol class="list-group list-group-numbered ">
                                    <?php
                                    $section_id = $row['id'];
                                    $query3 = "SELECT * FROM content WHERE section_id = '$section_id'";
                                    $result3 = $con->query($query3);
                                    if ($result3->num_rows > 0) {
                                        // output data of each row
                                        while ($row3 = $result3->fetch_assoc()) {
                                    ?>

                                            <li class="list-group-item bg-dark text-light">
                                                <a href="course_content.php?course_id=<?php echo $course_id ?>&section_id=<?php echo $row['id'] ?>&content_id=<?php echo $row3['id'] ?>" <?php
                                                                                                                                                                                            if ($row3['id'] == $content_id) {
                                                                                                                                                                                            ?> class="text-warning" <?php
                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                    ?> class="text-light" <?php
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                            ?>>
                                                    <?php echo $row3['name'] ?>
                                                </a>
                                            </li>

                                    <?php
                                        }
                                    } else {
                                        echo "no content";
                                    }

                                    ?>
                                </ol>
                            </div>
                    <?php
                        }
                    } else {
                        echo "No Sections";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-8">
                <?php
                $query = "SELECT * FROM content WHERE id = '$content_id'";
                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);

                ?>
                    <div class="card">
                        <iframe height="500px" src="https://www.youtube.com/embed/<?php echo $row['url'] ?>" allowfullscreen>
                        </iframe>
                        <div class="mt-3">
                            <h3><?php echo $row['name'] ?></h3>
                            <p><?php echo $row['description'] ?></p>
                            <a class="btn btn-dark" href="">Mark as complete</a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="card">
                        <h3 class="mt-4 mb-4">Sorry! Can't play this video.</h3>
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