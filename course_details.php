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
$id = "";
if (isset($_SESSION['LOGGEDIN'])) {
    $id = $_SESSION['USERID'];
}
$course_id = "";
if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
} else {
    header("location: 404.php");
}
$us = new User();
$user = $us->findUserByUserId($id);
$learner = new Learner();
$cor = new Course();
$course = $cor->findCourseById($course_id);
$cat = new Category();
$category = $cat->findCategoryById($course['category_id']);
$category_name = $category['name'];
$price = $course['price'];
$year = date('d/m/Y', strtotime($course['created_time']));
$active = "No";
if ($course['is_active'] == 1) {
    $active = "Yes";
}
$is_submitted = $course['is_submitted'];
$is_approved = $course['is_approved'];
$status = $cor->findStatus($course);
$picture = $course['picture'];

$course_instructor_id = $course['instructor_id'];
$ins = new Instructor();
$instructor_id = "";
if ($ins->findInstructor($id) != null) {
    $instructor = $ins->findInstructor($id);
    $instructor_id = $instructor['id'];
}

$is_bought = $learner->checkIfCourseBoughtByUser($course['id'], $id);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cor->addSection($_POST, $course_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/instructor_dashboard.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <link href="css/rating.css" rel="stylesheet">

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

        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #headCard {
            background-color: black;
            padding: 20px;
            color: white;
        }

        #addSection1 {
            margin-bottom: 5px;
        }

        #addSection2 {
            margin-bottom: 5px;
        }

        #addSection3 {
            margin-bottom: 5px;
        }

        .container>.card:nth-of-type(1)>div:nth-of-type(3) {
            display: flex;
            /* margin-bottom: 10px; */
            justify-content: flex-end;
        }

        .scectionParts {
            margin-bottom: 20px;
        }

        .scectionParts>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
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

        <div id="headCard" class="card">
            <div>
                <h3><?php echo $course['title']  ?></h3>

            </div>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p> <strong>Description:</strong> <?php echo $course['description'] ?></p>
                </div>
                <div class="col-md-3">
                    <p><strong>Category:</strong> <?php echo $category_name ?></p>
                    <p><strong>Price:</strong> <?php echo $price ?>$</p>
                    <p><strong>Created Time:</strong> <?php echo $year ?></p>
                    <p><strong>Active:</strong> <?php echo $active ?></p>
                    <p><strong>Status:</strong> <?php echo $status ?></p>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img height="150px" src="<?php echo $picture ?>" alt="">
                    </div>
                </div>
            </div>
            <?php
            if ($course_instructor_id == $instructor_id) {
            ?>
                <div>
                    <button class="btn btn-light">Edit Course</button>
                </div>
            <?php
            }
            ?>
        </div>





        <div class="row">



            <div class="col-md-3">
                <div class="card">
                    <?php
                    if ($course_instructor_id == $instructor_id) {
                    ?>
                        <!-- Button trigger modal -->
                        <button id=addSection1 type="button" class="btn btn-dark" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                            Add Section
                        </button>

                        <!-- Modal -->
                        <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="false" data-mdb-keyboard="true">
                            <div class="modal-dialog modal-lg  modal-dialog-centered">

                                <div class="modal-content">
                                    <form method="POST" action="">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Sections</h5>
                                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form-outline mb-4">
                                                <input name="name" type="text" id="form1Example1" class="form-control bg-light" required />
                                                <label class="form-label" for="form1Example1">Section Name</label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-mdb-dismiss="modal">
                                                Close
                                            </button>
                                            <button name="submit" type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <a id=addSection2 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View all students</a>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View Course Aanalytics</a>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View Course Discussion</a>
                        <?php
                        if ($is_submitted == 0 && $is_approved == 0) {
                        ?>
                            <a id=addSection3 href="course_submit.php?course_id=<?php echo $course_id ?>" class="btn btn-primary" type="button">Submit Course for publish</a>
                        <?php
                        }
                    } elseif ($us->checkIFAdmin($id) == true) {
                        ?>
                        <a id=addSection2 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View all students</a>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View Course Aanalytics</a>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View Course Discussion</a>
                    <?php
                    } elseif ($us->checkIFAdmin($id) != true && $course_instructor_id != $instructor_id && $is_bought != true) {
                    ?>
                        <a id=addSection2 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">Add to wishlist</a>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">Buy course</a>
                    <?php
                    } elseif ($is_bought == true) {
                    ?>
                        <a id=addSection3 href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">View Course Discussion</a>
                        <div>

                            <form method="POST" action="" class="modal-rating">
                                <div class="overlay"></div>

                                <h2>Rate this course</h2>

                                <div class="rating">
                                    <input type="radio" name="rate" id="rate-1" value="1" required>
                                    <label for="rate-1">1</label>

                                    <input type="radio" name="rate" id="rate-2" value="2" required>
                                    <label for="rate-2">2</label>

                                    <input type="radio" name="rate" id="rate-3" value="3" required>
                                    <label for="rate-3">3</label>

                                    <input type="radio" name="rate" id="rate-4" value="4" required>
                                    <label for="rate-4">4</label>

                                    <input type="radio" name="rate" id="rate-5" value="5" required>
                                    <label for="rate-5">5</label>

                                </div>
                                <button type="submit">Submit</button>
                            </form>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>








            <div class="col-md-9">
                <div class="card">
                    <?php

                    $query = "SELECT * FROM section WHERE course_id = '$course_id'";
                    $result = $con->query($query);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                            <div class="scectionParts">
                                <div>
                                    <h4><?php echo $row['name'] ?></h4>
                                    <?php
                                    if ($course_instructor_id == $instructor_id) {
                                    ?>
                                        <a href="add_content.php?course_id=<?php echo $row['course_id'] ?>&section_id=<?php echo $row['id'] ?>" class="btn btn-dark">Add Content</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <hr>
                                <div>
                                    <ol class="list-group list-group-light list-group-numbered">
                                        <?php
                                        $section_id = $row['id'];
                                        $query3 = "SELECT * FROM content WHERE section_id = '$section_id'";
                                        $result3 = $con->query($query3);
                                        if ($result3->num_rows > 0) {
                                            // output data of each row
                                            while ($row3 = $result3->fetch_assoc()) {
                                                if ($is_bought == true || $course_instructor_id == $instructor_id || $us->checkIFAdmin($id) == true) {

                                        ?>
                                                    <li class="list-group-item ">
                                                        <a href="course_content.php?course_id=<?php echo $course_id ?>&section_id=<?php echo $row['id'] ?>&content_id=<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?> <span class="text-warning">(<?php echo $row3['point'] ?>)</span></a>
                                                    </li>
                                                    <?php
                                                } else {
                                                    if ($row3['is_preview'] == true) {
                                                    ?>
                                                        <li class="list-group-item ">
                                                            <a href="course_content.php?course_id=<?php echo $course_id ?>&section_id=<?php echo $row['id'] ?>&content_id=<?php echo $row3['id'] ?>"><?php echo $row3['name'] ?> <span class="text-warning">(<?php echo $row3['point'] ?>)</span></a>
                                                        </li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li class="list-group-item">
                                                            <span><?php echo $row3['name'] ?> <span class="text-warning">(<?php echo $row3['point'] ?>)</span></span>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>
                                        <?php

                                                }
                                            }
                                        } else {
                                            echo "no content";
                                        }

                                        ?>
                                    </ol>
                                </div>

                            </div>

                        <?php
                        }
                    } else {
                        ?>
                        <div class="card">
                            <h4 class="card-title">No Section Found</h4>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

</body>

</html>