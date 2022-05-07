<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");


session_start();

$id = $_SESSION['USERID'];
$course_id = $_GET['course_id'];
$section_id = $_GET['section_id'];
$ins = new Instructor();
$cor = new Course();
$ins_id = "";
if ($ins->findInstructor($id) == null) {
    header("location: no_access.php");
} else {
    $instructor = $ins->findInstructor($id);
    $ins_id = $instructor['id'];
}

if ($cor->isCourseByInstructorId($ins_id, $course_id) != true) {
    header("location: no_access.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cor->addContentToSection($_POST, $section_id,$course_id);
    header("location: course_details.php?id=".$course_id);
}




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

        .container>.card:nth-last-of-type(1)>div:nth-of-type(1) {
            margin-bottom: 30px;
            /* border: 1px solid red; */
            border-radius: 5px;
        }

        .container>.card:nth-last-of-type(1)>div:nth-of-type(1) h3 {
            padding: 10px;
            font-weight: 400;
        }
    </style>

</head>

<body>

    <?php include "utility/instructor_navbar.php" ?>

    <div class="container">

        <div class="card">
            <div class="bg-dark text-light">
                <h3>Add Content</h3>
            </div>
            <div>
                <form method="POST" action="">
                    <div>
                        <div class="form-outline mb-4">
                            <input name="title" type="text" id="form1Example1" class="form-control" required />
                            <label class="form-label" for="form1Example1">Content Title</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea name="description" class="form-control" id="form4Example3" rows="4"></textarea>
                            <label class="form-label" for="form4Example3">Content Description</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input name="url" type="url" id="form1Example2" class="form-control" required />
                            <label class="form-label" for="form1Example2">Youtube Video URL</label>
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input name="preview" class="form-check-input" type="checkbox" id="form1Example3" />
                                    <label class="form-check-label" for="form1Example3"> Active Preview </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-dark">
                        <button name="submit" type="submit" class="btn btn-dark btn-block">Add</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

</body>

</html>