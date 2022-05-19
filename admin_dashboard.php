<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");
require_once("models/admin.php");


session_start();
$db = new Database();
$con = $db->connect_db();
$id = $_SESSION['USERID'];

$admin = new Admin();
if ($admin->is_admin($id) == false) {
    header("location: no_access.php");
}

// $value = array();
// for ($i = 1; $i < 6; $i++) {
//     $value += array($i => $i + 10);
// }

$value = $admin->findLast7DayUser();






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

        .container>.card:nth-of-type(1) {
            border-radius: 0;
        }

        .container>.card:nth-of-type(1) ul {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            padding: 0;
            margin: 0;
        }

        @media only screen and (max-width: 600px) {
            .container>.card:nth-of-type(1) ul {
                display: flex;
                flex-direction: column;
                justify-content: space-around;
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <?php include "utility/admin_navbar.php" ?>

    <div class="container">
        <div class="card bg-dark mt-3 mb-3">
            <ul>
                <a class="text-warning" href="admin_dashboard.php">Dashboard</a>
                <a class="text-light" href="">Learner</a>
                <a class="text-light" href="admin_course.php">Course</a>
                <a class="text-light" href="">Instructor</a>
                <a class="text-light" href="">Employer</a>
                <a class="text-light" href="">Job</a>
            </ul>
        </div>

        <div id="section2" class="mb-3">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Users</h5>
                        <h2>300</h2>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Revenue</h5>
                        <h2>$400</h2>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <h5>Total Courses</h5>
                        <h2>500</h2>
                    </div>
                </div>
            </div>
        </div>


        <div id="section3" class="mb-3">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <canvas id="myChart" style="width:100%;"></canvas>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <canvas id="myChart2" style="width:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        var xValues = [];
        var yValues = [];
        var barColors = ["red", "green", "blue", "orange", "brown"];


        <?php
        foreach ($value as $key => $value) {
        ?>
            xValues.push(<?php echo $key ?>);
            yValues.push(<?php echo $value ?>);
        <?php
        }
        ?>

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Users resgisterd in last 7 days"
                }
            }
        });


        var xxValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
        var yyValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xxValues,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yyValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 6,
                            max: 16
                        }
                    }],
                },
                title: {
                    display: true,
                    text: "Users resgisterd in last 7 days"
                }
            }
        });
    </script>

</body>

<?php

$value = $admin->findLast7DayUser();

foreach($value as $x => $x_value){
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}

?>

</html>