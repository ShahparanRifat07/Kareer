<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/category.php");


session_start();
$db = new Database();
$con = $db->connect_db();

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}

$us = new User();
$learner = new Learner();

$learner_id = "";
if ($learner->findLearnerByUserID($user_id) != false) {
    $current_learner = $learner->findLearnerByUserID($user_id);
    $learner_id = $current_learner['id'];
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/profile.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #fcde67;
        }

        .noBorderRedius {
            border-radius: 0;
        }

        .noMarginPadding {
            margin: 0;
            padding: 0;
        }

        .divCenter {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

</head>

<body>
    <?php include "utility/navbar.php" ?>
    <div class="container">
        <div class="card mt-3 mb-3 noBorderRedius text-light bg-dark">
            <h1 class="ms-auto me-auto">Purchase History</h1>
        </div>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Course</th>
                    <th scope="col">Transection time</th>
                    <th scope="col">Transection id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT course.title,course.id,transaction_id,transaction_time
                            FROM course_transaction
                            JOIN course
                            ON course_transaction.course_id = course.id
                            WHERE learner_id = '$learner_id'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $rank = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $rank ?></th>
                            <td><?php echo $row['title'] ?></td>
                            <td><?php echo $row['transaction_time'] ?></td>
                            <td><?php echo $row['transaction_id'] ?></td>
                        </tr>

                <?php
                        $rank = $rank + 1;
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php include "utility/footer.php" ?>

    <script>
        function wannaApply() {
            alert("Do you want to apply to this job?");
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>


</html>