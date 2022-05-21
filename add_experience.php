<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");

session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$user_id = $_SESSION['USERID'];
$db = new Database();
$con = $db->connect_db();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $user->addExperience($_POST,$user_id);
}

$job_types = array("Full-time","Part-time","Contract","Temporary","Internship","Remote");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <!-- <link href="css/instructor.css" rel="stylesheet"> -->
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

        .dropdown-menu {
            max-height: 280px;
            overflow-y: auto;
            /* border: 1px solid red; */
        }

        .card {
            border-radius: 0;
        }

        .select {
            height: 30px;
            /* border: 1px solid red; */
            text-align: center;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>

    <div class="container">
        <div class="card bg-dark mt-3">
            <h2 class="text-light">Add Experience</h2>
        </div>

        <div class="instructor_form mb-4">
            <div class="card p-4">
                <form method="POST" action="" >

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input name="title" type="text" id="form6Example3" class="form-control" required />
                        <label class="form-label" for="form6Example3">Job Title*</label>
                    </div>

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input name="company" type="text" id="form6Example3" class="form-control" required>
                        <label class="form-label" for="form6Example3">Company Name*</label>
                    </div>


                    <div class="mb-4">
                        <select class="select w-100" name="type">
                            <div class="selectOption">
                                <option selected disabled>Job Type*</option>
                                <?php
                                foreach($job_types as $type){
                                ?>
                                        <option value=<?php echo $type ?>><?php echo $type ?></option>
                                <?php
                                }
                                ?>
                            </div>
                        </select>
                    </div>



                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="start" type="text" id="form3Example1" class="form-control" required/>
                                <label class="form-label" for="form3Example1">Start Year</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="end" type="text" id="form3Example2" class="form-control"/>
                                <label class="form-label" for="form3Example2">End Year</label>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input name="location" type="text" id="form6Example3" class="form-control" required/>
                        <label class="form-label" for="form6Example3">Location*</label>
                    </div>


                    <hr>

                    <!-- Submit button -->
                    <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Add to profile</button>
                </form>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>