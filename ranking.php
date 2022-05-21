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
            <h1 class="ms-auto me-auto">Ranking</h1>
        </div>

        <table class="table align-middle mb-0 bg-white mb-4">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>School</th>
                    <th>Country</th>
                    <th>Rank</th>
                    <th>Total Points</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT SUM(con.point) AS total_points, complete.learner_id as learner_id, user.id as user_id,learner_profile.profile_pic,user.first_name,user.last_name,
                (
                    SELECT education.school
                    FROM education
                    WHERE education.user_id = user.id
                    ORDER BY education.id DESC
                    LIMIT 1
                ) AS school
                ,learner_profile.country
                            FROM complete_content as complete
                            JOIN content as con
                            ON complete.content_id = con.id
                            JOIN section as sec
                            ON con.section_id = sec.id
                            JOIN course as cor
                            ON sec.course_id = cor.id
                            JOIN learner_profile
                            ON complete.learner_id = learner_profile.id
                            JOIN user
                            ON learner_profile.user_id = user.id
                            LEFT JOIN education
                            ON education.user_id = user.id
                            GROUP BY complete.learner_id
                            ORDER BY total_points DESC;";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    $rank = 1;
                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo $row['profile_pic'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <a href="profile.php?user_id=<?php echo $row['user_id'] ?>" class="fw-bold mb-1"><?php echo $row['first_name'] ?> <?php echo $row['last_name'] ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php
                                if (empty($row['school'])) {
                                ?>
                                    <p class="text-muted mb-0">Not Provided</p>
                                <?php
                                } else {
                                ?>
                                    <p class="fw-normal mb-1"><?php echo $row['school'] ?></p>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (empty($row['country'])) {
                                ?>
                                    <p class="text-muted mb-0">Not Provided</p>
                                <?php
                                } else {
                                ?>
                                    <p class="fw-normal mb-1"><?php echo $row['country'] ?></p>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><?php echo $rank ?></p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"><i class="fa-solid fa-star"></i> <?php echo $row['total_points'] ?></p>
                            </td>
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