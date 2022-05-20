<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
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
$job = new Job();

if (($emp->checkIsEmployer($user_id)) != true) {
    header("location: no_access.php");
}

$learner_id = "";
if (isset($_GET['learner_id'])) {
    $learber_id = $_GET['learner_id'];
} else {
    header("location: 404.php");
}


$job_id = "";
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
} else {
    header("location: 404.php");
}

$user = new User();
$learner = new Learner();
$current_user = $user->findUserByLearnerID($learber_id);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $job->callLearnerForInterview($_POST,$learber_id,$job_id);
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
    <?php include "utility/navbar.php" ?>

    <div class="container">
        <div class="card bg-dark mt-3">
            <h5 class="text-light ms-auto me-auto">Call <span class="text-warning"><?php echo $current_user['first_name'] ?>  <?php echo $current_user['last_name'] ?></span> </h5>
        </div>

        <div class="instructor_form mb-4">
            <div class="card p-4">
                <form method="POST" action="" >

                    <!-- Text input -->
                    <div class="form-outline mb-4">
                        <input value="<?php echo $current_user['first_name'] ?>  <?php echo $current_user['last_name'] ?>" name="name" type="text" id="form6Example3" class="form-control" disabled/>
                        <label class="form-label" for="form6Example3">Name</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input value="<?php echo $current_user['email'] ?>" name="email" type="text" id="form6Example3" class="form-control" disabled/>
                        <label class="form-label" for="form6Example3">Email</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input name="date" type="text" id="form6Example3" class="form-control" required placeholder="01/05/2022"/>
                        <label class="form-label" for="form6Example3">Interview Date*</label>
                    </div>

                    <hr>

                    <!-- Submit button -->
                    <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Call</button>
                </form>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>