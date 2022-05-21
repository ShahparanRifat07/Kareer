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


$cat = new Category();
$ins = new Instructor();
$cor = new Course();


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

        #section2>div {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
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
                <a class="text-light" href="admin_dashboard.php">Dashboard</a>
                <!-- <a class="text-light" href="">Learner</a> -->
                <a class="text-warning" href="admin_course.php">Course</a>
                <!-- <a class="text-light" href="">Instructor</a> -->
                <!-- <a class="text-light" href="">Employer</a> -->
                <a class="text-light" href="">Job</a>
            </ul>
        </div>

        <div id="section2" class="mb-3">
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" id="form1" class="form-control" />
                    <label class="form-label" for="form1">Search</label>
                </div>
                <button type="button" class="btn btn-dark">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div id="section3" class="mb-3">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Title & Instructor</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>price</th>
                        <th>Created Time</th>
                        <th>Review</th>
                        <th>Approve</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $query = "Select * FROM course ORDER BY created_time DESC";
                    $result = mysqli_query($con, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $instructor = $ins->findInstructorByInstructorID($row['instructor_id']);
                            $category = $cat->findCategoryById($row['category_id']);
                            $status = $cor->findStatus($row);
                            $created_time = date('d/m/Y', strtotime($row['created_time']));
                    ?>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $row['picture'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1"><?php echo $row['title']  ?></p>
                                            <p class="text-muted mb-0"><?php echo $instructor['instructor_name'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?php echo $category['name'] ?></p>
                                </td>
                                <td>
                                    <span <?php
                                            if ($status == "Drafted") {
                                            ?> class="badge badge-primary rounded-pill d-inline" <?php
                                                                                                }
                                                                                                    ?> <?php
                                                                                                        if ($status == "Submitted") {
                                                                                                        ?> class="badge badge-warning rounded-pill d-inline" <?php
                                                                                                                                                            }
                                                                                                                                                                ?> <?php
                                                                                                                                                                    if ($status == "Approved") {
                                                                                                                                                                    ?> class="badge badge-success rounded-pill d-inline" <?php
                                                                                                                                                                                                                        }
                                                                                                                                                                                                                            ?>>
                                        <?php echo $status ?>
                                    </span>
                                </td>
                                <td>$<?php echo $row['price'] ?></td>
                                <td><?php echo $created_time ?></td>
                                <td>
                                    <a href="course_details.php?id=<?php echo $row['id'] ?>" type="button" class="btn btn-link btn-sm btn-rounded">
                                        view
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    if ($row['is_approved'] == 1) {
                                    ?>
                                        <p>Approved</p>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($row['is_submitted'] == 1) {
                                    ?>
                                        <a href="course_approve.php?course_id=<?php echo $row['id'] ?>" type="button" class="btn btn-warning btn-sm btn-rounded">
                                            Approve
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a onclick="wannaDelete()" href="course_delete.php?course_id=<?php echo $row['id'] ?>" type="button" class="btn btn-danger btn-sm btn-rounded">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>



    <?php include "utility/footer.php" ?>
    <!-- MDB -->
    <!-- <script type="text/javascript" src="js/main.js"></script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>

    <script>
        function wannaDelete() {
            alert("Do you want to Delete this course?");
        }
    </script>
</body>

</html>