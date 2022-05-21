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

$user = new User();
$current_user = $user->findUserByUserId($user_id);
$learner = new Learner();
$current_learner = $learner->findLearnerByUserID($user_id);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $learner->UpdateProfilePicture($_FILES, $current_learner['id'],$user_id);
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
            <h2 class="text-light">Change Profile Picture</h2>
        </div>

        <div class="instructor_form mb-4">
            <div class="card p-4">
                <form method="POST" action=""  enctype="multipart/form-data">

                    <!-- Text input -->

                        <label class="form-label" for="customFile">Upload Proflie Picture</label>
                        <input name="picture" type="file" class="form-control" id="customFile" />
                    <hr>

                    <!-- Submit button -->
                    <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Change</button>
                </form>
            </div>
        </div>

    </div>

    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>