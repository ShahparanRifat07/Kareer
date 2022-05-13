<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/instructor.php");
require_once("models/category.php");
require_once("models/course.php");

session_start();
$db = new Database();
$con = $db->connect_db();

if (!isset($_SESSION['LOGGEDIN'])) {
    header("location: login.php");
}

$user_id = "";
if (isset($_SESSION['USERID'])) {
    $user_id = $_SESSION['USERID'];
}
$course_id = "";

if(isset($_GET['course_id'])){
    $course_id = $_GET['course_id'];
}else{
    header("location: 404.php");
}



$cor = new Course();
$course = $cor->findCourseById($course_id);
$ins = new Instructor();
$instructor = $ins->findInstructorByInstructorID($course['instructor_id']);
$cat = new Category();
$category = $cat->findCategoryById($course['category_id']);
$learner = new Learner();
$learner->checkIfCourseBought($course_id,$user_id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $learner->buyCourse($course_id,$user_id);    
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

    <style>
        body {
            background-color: #fcde67;
        }
    </style>
    <title>Document</title>
</head>

<body>

    <?php include "utility/navbar.php" ?>

    <div class="container">
        <div class="mt-4 mb-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="card bg-dark">
                        <h3 class="text-light">Summary</h3>
                        <hr>
                        <div class="card bg-dark">
                            <img src="<?php echo $course['picture']  ?>" alt="" height="250px">
                        </div>
                        <div class="ms-3">
                            <h4 class="text-light">Course Info:</h4>
                            <hr>
                            <p class="text-light"> Title: <?php echo $course['title']?></p>
                            <p class="text-light">Author: <?php echo $instructor['instructor_name']?></p>
                            <p class="text-light">Category: <?php echo $category['name']  ?></p>
                            <h2 class="text-warning">Price: $<?php echo $course['price']?></h2>
                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">

                    <h3>Checkout</h3>
                    <hr>

                        <form method="POST" action="">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="number" id="form3Example3" class="form-control" placeholder="1234 1234 1234 1234" required />
                                <label class="form-label" for="form3Example3">Card Number</label>
                            </div>

                            <!-- 2 column grid layout with text inputs for the first and last names -->
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form3Example1" class="form-control" placeholder="MM/YY" required/>
                                        <label class="form-label" for="form3Example1">Expiration date</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form3Example2" class="form-control" placeholder="CVV" required/>
                                        <label class="form-label" for="form3Example2">Security code</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-dark btn-block mb-4">Pay $<?php echo $course['price'] ?></button>
                        </form>

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