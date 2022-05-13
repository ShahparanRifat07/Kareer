<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/instructor.php");

session_start();

if($_SESSION['LOGGEDIN'] != true){
    header('location: login.php');
}

$db = new Database();
$con = $db->connect_db();
$id = $_SESSION['USERID'];

$ins = new Instructor();

if(($ins->findInstructor($id))!=null){
    header("location: instructor_dashboard.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_POST['id'] = $_SESSION['USERID'];
    echo $ins->createInstructor($_POST);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="css/instructor.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
    <!-- <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

    <style>
        body {
            background-color: #fcde67;
        }
    </style>
</head>

<body>
    <?php include "utility/just_navbar.php" ?>

    <div class="insform-header ">
        <h2 class="text-dark">Become An Instructor</h2>
    </div>

    <div class="instructor_form">
        <div class="card p-4">
            <form method="POST" action="">

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <input name="name" type="text" id="form6Example3" class="form-control" />
                    <label class="form-label" for="form6Example3">Instructor Profile Name*</label>
                </div>

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <input name="headline" type="text" id="form6Example3" class="form-control" placeholder="EX: Software Engineer"/>
                    <label class="form-label" for="form6Example3">Headline*</label>
                </div>

                <!-- Message input -->
                <div class="form-outline mb-4">

                    <textarea name="about" class="form-control" id="form6Example7" rows="4"></textarea>
                    <label class="form-label" for="form6Example7">About Me</label>
                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col">
                        <p>Previous Teaching Experience</p>
                    </div>
                    <div class="col">
                        <div class="btn-group">
                            <input type="radio" value="none" class="btn-check" name="teaching_exp" id="option1" autocomplete="off" checked />
                            <label class="btn btn-light" for="option1">None</label>

                            <input type="radio" value="inperson" class="btn-check" name="teaching_exp" id="option2" autocomplete="off" />
                            <label class="btn btn-light" for="option2">In Person</label>

                            <input type="radio" value="online" class="btn-check" name="teaching_exp" id="option3" autocomplete="off" />
                            <label class="btn btn-light" for="option3">Online</label>
                        </div>
                    </div>
                    <div class="col">
                        <p>Online Course Making Experience</p>
                    </div>
                    <div class="col">
                        <div class="btn-group">
                            <input value="none" type="radio" class="btn-check" name="course_exp" id="option4" autocomplete="off" checked />
                            <label class="btn btn-light" for="option4">None</label>

                            <input value="medium" type="radio" class="btn-check" name="course_exp" id="option5" autocomplete="off" />
                            <label class="btn btn-light" for="option5">One or two</label>

                            <input value="expert" type="radio" class="btn-check" name="course_exp" id="option6" autocomplete="off" />
                            <label class="btn btn-light" for="option6">five or more</label>
                        </div>
                    </div>
                </div>

                <hr>

                <label for="basic-url" class="form-label">Website (Optional)</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">https://website.com/</span>
                    <input name="website" type="text" class="form-control" id="basic-url1" aria-describedby="basic-addon3" />
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-dark btn-block mb-4">Join</button>
            </form>
        </div>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <!-- Include the Quill library -->
    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->

    <!-- Initialize Quill editor -->
    <!-- <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Additional information',
        });
    </script> -->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>