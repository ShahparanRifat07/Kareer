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
$cor = new Course();
$course = $cor->findCourseById($course_id);
$cat = new Category();
$category = $cat->findCategoryById($course['category_id']);
$category_name = $category['name'];
$price = $course['price'];
$year = date('d/m/Y', strtotime($course['created_time']));
$active = "No";
if ($course['is_active'] == 1) {
    $active = "Yes";
}
$status = $cor->findStatus($course);
$picture = $course['picture'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cor->addSection($_POST,$course_id);
    
}

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

        .container .card:nth-of-type(1)>a {
            margin: 5px;
        }

        .container>.card:nth-of-type(1)>div:nth-of-type(3) {
            display: flex;
            margin-bottom: 10px;
            justify-content: flex-end;
        }
    </style>

</head>

<body>

    <?php include "utility/instructor_navbar.php" ?>

    <div class="container">

        <div class="card">
            <div>
                <h3><?php echo $course['title']  ?></h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <p> <strong>Description:</strong> <?php echo $course['description'] ?></p>
                </div>
                <div class="col-md-3">
                    <p><strong>Category:</strong> <?php echo $category_name ?></p>
                    <p><strong>Price:</strong> <?php echo $price ?>$</p>
                    <p><strong>Created Time:</strong> <?php echo $year ?></p>
                    <p><strong>Active:</strong> <?php echo $active ?></p>
                    <p><strong>Status:</strong> <?php echo $status ?></p>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo $picture ?>" alt="">
                    </div>
                </div>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
                    Launch demo modal
                </button>

                <!-- Modal -->
                <div class="modal top fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-mdb-backdrop="false" data-mdb-keyboard="true">
                    <div class="modal-dialog modal-lg  modal-dialog-centered">

                        <div class="modal-content">
                            <form method="POST" action="">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Sections</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form1Example1" class="form-control" />
                                        <label class="form-label" for="form1Example1">Section Name</label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <a href="add_section.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">Add Section</a>
                    <a href="add_assignment.php?course_id=<?php echo $course_id ?>" class="btn btn-dark" type="button">Add Assignment</a>
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