<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");
require_once("models/job.php");



session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$user_id = $_SESSION['USERID'];
$db = new Database();
$con = $db->connect_db();
$emp = new Employer();

if ($emp->checkIsEmployer($user_id) == false) {
    header("location: no_access.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job = new Job();
    $error = $job->valid($_POST);
    if(empty($error)){
        $_SESSION['JOB'] = $_POST;
        header("location: job_post_payment.php");
    }else{
        echo $error;
    }
}

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
    <?php include "utility/employer_navbar.php" ?>

    <div class="container">
        <div class="card bg-dark mt-3">
            <h2 class="text-light">Create Job Post</h2>
        </div>

        <div class="instructor_form mb-4">
            <div class="card p-4">
                <form method="POST" action="" enctype="multipart/form-data">

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input name="title" type="text" id="form6Example3" class="form-control" />
                        <label class="form-label" for="form6Example3">Job Title*</label>
                    </div>

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <textarea name="description" type="text" id="form6Example3" class="form-control" rows="8"></textarea>
                        <label class="form-label" for="form6Example3">Job Description*</label>
                    </div>

                    <div class="mb-4">
                        <select class="select w-100" name="type">
                            <div class="selectOption">
                                <option selected disabled>Job Type*</option>
                                <?php
                                $query = "SELECT * FROM job_type";
                                $result = mysqli_query($con, $query);
                                // echo $result;
                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value=<?php echo $row['id'] ?>><?php echo $row['type'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </select>
                    </div>

                    <div class="mb-4">
                        <select class="select w-100" name="schedule">
                            <div class="selectOption">
                                <option selected disabled>Job Schedule*</option>
                                <?php
                                $query = "SELECT * FROM job_schedule";
                                $result = mysqli_query($con, $query);
                                // echo $result;
                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value=<?php echo $row['id'] ?>><?php echo $row['schedule'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </select>
                    </div>



                    <div class="form-outline mb-4">
                        <input name="people" type="number" min="0" id="form6Example3" class="form-control" />
                        <label class="form-label" for="form6Example3">How many people do you want to hire</label>
                    </div>


                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <label class="mb-2" for="">Salary Range* (Per Year)</label>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input name="minimum" type="number" min="0" id="form3Example1" class="form-control" />
                                <label class="form-label" for="form3Example1">Minimum</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input name="maximum" type="number" min="0" id="form3Example2" class="form-control" />
                                <label class="form-label" for="form3Example2">Maximum</label>
                            </div>
                        </div>
                    </div>


                    <div class="mb-4">
                        <select class="select w-100" name="location">
                            <div class="selectOption">
                                <option selected disabled>Location*</option>
                                <?php
                                $query = "SELECT * FROM location";
                                $result = mysqli_query($con, $query);
                                // echo $result;
                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <option value=<?php echo $row['id'] ?>><?php echo $row['location'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </select>
                    </div>

                    <hr>

                    <!-- Submit button -->
                    <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Post This job</button>
                </form>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>