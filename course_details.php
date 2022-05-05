<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");


session_start();

$db = new Database();
$con = $db->connect_db();
$id = $_SESSION['USERID'];
$course_id = $_GET['id'];

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
            background-color: #EEEEEE;
        }
        .card {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .container .card:nth-of-type(1)> button{
            margin: 5px;
        }
    </style>

</head>

<body>

    <?php include "utility/instructor_navbar.php" ?>

    <div class="container">
        <div class="card">
            
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <button class="btn btn-dark" type="button">Add Section</button>
                    <button class="btn btn-dark" type="button">Add Assignment</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    world
                </div>
            </div>
        </div>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

</body>

</html>