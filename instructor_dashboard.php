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

$inst = new Instructor();
if($inst->findInstructor($id) == null){
    header("location: no_access.php");
}

if (isset($_GET['view'])) {
    // echo $_GET['view'];
    echo "hello";
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
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
        body {
            background-color: #EEEEEE;
        }

        .container>.card:nth-of-type(1) {
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 25px;
            border-top: 3px solid black;
        }

        .container>.card:nth-of-type(1) h4 {
            font-weight: 400;
        }

        .container>.card:nth-of-type(1)>.row {
            /* border: 1px solid red; */
            margin-top: 20px;
        }

        .container>.card:nth-of-type(1)>.row .card {
            border: 1px solid #E0E0E0;
            padding: 5px;
            min-width: 100px;
        }

        .container>.card:nth-of-type(1)>.row .card .card-body {
            /* border: 1px solid red; */
            padding: 10px;
        }

        .container>.card:nth-of-type(1)>.row .card .card-body a {
            /* border: 1px solid red; */
            display: flex;
            justify-content: center;
        }


        .container>.card:nth-of-type(1)>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
        }


        .container>.card:nth-of-type(2) {
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 25px;
            border-top: 3px solid black;
        }

        .container>.card:nth-of-type(2) h4 {
            font-weight: 400;
        }

        .container>.card:nth-of-type(2)>.row {
            /* border: 1px solid red; */
            margin-top: 20px;
        }

        .container>.card:nth-of-type(2)>.row .card {
            /* border: 1px solid red; */
            padding: 5px;
            min-width: 100px;
        }

        .container>.card:nth-of-type(2)>.row .card .card-body {
            /* border: 1px solid red; */
            padding: 10px;
        }

        .container>.card:nth-of-type(2)>.row .card .card-body a {
            /* border: 1px solid red; */
            display: flex;
            justify-content: center;
        }

        .container>.card:nth-of-type(2)>div:nth-of-type(1) {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>


<body>
    <?php include "utility/instructor_navbar.php" ?>
    <!-- <h1><?php echo $_SESSION["USERID"] ?></h1> -->


    <div class="container">

        <div class="card">
            <div>
                <h4 class="card-title">Draft Courses</h4>
                <button class="btn btn-dark">View all</button>
            </div>

            <div class="row">

                <?php
                $ins = new Instructor();
                $instructor = $ins->findInstructor($id);
                $ins_id = $instructor['id'];
                $query = "SELECT id, title, price, picture FROM course WHERE instructor_id = '$ins_id' ORDER BY created_time DESC LIMIT 3 ";
                $result = $con->query($query);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {

                ?>

                        <!-- <p><?php echo $row['title'] ?></p>
                        <p><?php echo $row['picture'] ?></p>
                        <p><?php echo $row['price'] ?></p> -->
                        <!-- <p><?php echo $ins_name ?></p> -->

                        <div class="col-4">
                            <div class="card">
                                <img src="<?php echo $row['picture'] ?>" class="card-img-top" height="100px" alt="Fissure in Sandstone" />
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row["title"] ?></h5>
                                    <p class="card-text"><?php echo $instructor['instructor_name'] ?></p>
                                    <p class="card-text">Price: <?php echo $row["price"] ?>$</p>

                                    <a href="course_details.php?id=<?php echo $row['id'] ?>" class="btn btn-dark btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="card">
                        <h4 class="card-title">No Courses Found</h4>
                    </div>
                <?php
                }

                ?>
            </div>

        </div>


        <div class="card">
            <div>
                <h4 class="card-title">Published Courses</h4>
                <button class="btn btn-dark">View all</button>
            </div>

            <div class="row">

                <div class="col-4">
                    <div class="card">
                        <img src="https://www.imgacademy.com/themes/custom/imgacademy/images/helpbox-contact.jpg" class="card-img-top" height="100px" alt="Fissure in Sandstone" />
                        <div class="card-body">
                            <h5 class="card-title">Learn Django</h5>
                            <p class="card-text">Shahparan Rifat</p>
                            <p class="card-text">Price: 24$</p>

                            <a href="#!" class="btn btn-dark btn-sm">View</a>
                        </div>
                    </div>
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