<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");

session_start();

if ($_SESSION['LOGGEDIN'] != true) {
    header('location: login.php');
}

$db = new Database();
$con = $db->connect_db();
$id = $_SESSION['USERID'];

$emp = new Employer();

if (($emp->checkIsEmployer($id)) != true) {
    header("location: no_access.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/profile.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <title>Document</title>

    <style>
        body {
            background-color: #fcde67;
        }
    </style>
</head>

<body>
    <?php include "utility/employer_navbar.php" ?>

    <div class="container">
        <div class="card mt-4">

            <div class="row">
                <div class="col-md-3">
                    <img src="https://play-lh.googleusercontent.com/1cqAnD-lDTtohKEUE_oJ6hTubEwiXLKTjV8WCf6SJJA73d05qnvJ_HXeBvs3nQQZHj0" alt="" height="200px" width="200px">
                </div>
                <div class="col-md-9">
                    <h5>HTC GROUP</h5>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores cumque deleniti aliquid quam </p>
                    <p>Software development</p>
                </div>
            </div>
        </div>
    </div>

    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>