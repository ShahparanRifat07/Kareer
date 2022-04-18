<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/Course.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $course = new Course();
    // $_POST['id'] = $_SESSION['USERID'];
    // echo $course->createCourse($_POST);
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

</head>

<body>
    <?php include "utility/instructor_navbar.php" ?>

    <div class="insform-header ">
        <h2 class="text-dark">Coures Creation</h2>
    </div>

    <div class="instructor_form">
        <div class="card p-4">
            <form method="POST" action="">

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <input name="title" type="text" id="form6Example3" class="form-control" />
                    <label class="form-label" for="form6Example3">Course Title*</label>
                </div>

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <textarea name="Description" type="text" id="form6Example3" class="form-control" rows="4"></textarea>
                    <label class="form-label" for="form6Example3">Description</label>
                </div>

                <!-- Message input -->
                <!-- <div class="form-outline mb-4"> -->
                    <div class="dropdown ">
                        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-mdb-toggle="dropdown" aria-expanded="false">
                            Category
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                <!-- </div> -->

                <hr>

                
                <hr>

                <!-- Submit button -->
                <button type="submit" class="btn btn-dark btn-block mb-4">Submit</button>
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