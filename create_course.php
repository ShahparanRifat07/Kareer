<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/instructor.php");
require_once("models/course.php");
require_once("models/category.php");

session_start();

$id = $_SESSION['USERID'];
$ins = new Instructor();
if($ins->findInstructor($id) == null){
    header("location: no_access.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course = new Course();
    $_POST['id'] = $_SESSION['USERID'];
    $course->createCourse($_POST,$_FILES);
    
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <link href="css/instructor.css" rel="stylesheet">
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

        .select {
            height: 30px;
            /* border: 1px solid red; */
            text-align: center;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <?php include "utility/instructor_navbar.php" ?>



    <div class="insform-header ">
        <h2 class="text-dark">Coures Creation</h2>
    </div>

    <div class="instructor_form">
        <div class="card p-4">
            <form method="POST" action="" enctype="multipart/form-data">

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <input name="title" type="text" id="form6Example3" class="form-control" />
                    <label class="form-label" for="form6Example3">Course Title*</label>
                </div>

                <!-- Text input -->
                <div class="form-outline mb-4">
                    <textarea name="description" type="text" id="form6Example3" class="form-control" rows="4"></textarea>
                    <label class="form-label" for="form6Example3">Description</label>
                </div>

                <div class="mb-4">
                    <select class="select w-100" name="category">
                        <div class="selectOption">
                            <option selected disabled>Choose Category</option>

                            <?php
                            // $cat = new Category();
                            // $result = $cat->getAllCategories();

                            $db = new Database();
                            $con = $db->connect_db();

                            $query = "SELECT * FROM category";
                            $result = mysqli_query($con, $query);
                            // echo $result;
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <!-- <li class="dropdown-item" value=<?php echo $row['name'] ?> name="category"><?php echo $row['name'] ?></li> -->
                                    <option value=<?php echo $row['id'] ?>><?php echo $row['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </select>
                </div>



                <div class="form-outline mb-4">
                    <input name="price" type="number" min="0" id="form6Example3" class="form-control" />
                    <label class="form-label" for="form6Example3">Price</label>
                </div>

                <label class="form-label" for="customFile">Upload Course Thumbnail</label>
                <input name="picture" type="file" class="form-control"  id="customFile" />

                <hr>

                <!-- Submit button -->
                <button name="submit" type="submit" class="btn btn-dark btn-block mb-4">Save to Draft</button>
            </form>
        </div>
    </div>


    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <!-- Include the Quill library -->
    <!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->

    <!-- Initialize Quill editor -->
    <!-- <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Additional information',
        });
    </script> -->
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>