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
$user_id = $_SESSION['USERID'];

$emp = new Employer();

if (($emp->checkIsEmployer($user_id)) == true) {
    header("location: employer_dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $emp->createEmployer($_POST,$_FILES, $user_id);
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <!-- <link href="css/instructor.css" rel="stylesheet"> -->
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

        .container>.card:nth-of-type(1) {
            border-radius: 0;
        }

        .container>.card:nth-of-type(2) {
            border-radius: 0;
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
    <?php include "utility/just_navbar.php" ?>

 
    <div class="container mt-4 mb-4">
        <div class="card bg-dark ">
            <h2 class="text-light">Become An Employer</h2>
        </div>

        <div class="card p-4">
            <form method="POST" action="" enctype="multipart/form-data">

                
                <div class="form-outline mb-4">
                    <input name="name" type="text" id="form6Example3" class="form-control" required />
                    <label class="form-label" for="form6Example3">Company Name*</label>
                </div>

                
                <div class="form-outline mb-4">
                    <textarea name="about" class="form-control" id="form6Example7" rows="6"></textarea>
                    <label class="form-label" for="form6Example7">Company Description</label>
                </div>

                <hr>

                <div class="form-outline mb-4">
                    <select class="select w-100" name="industry">
                        <div>
                            <option selected disabled>Choose Industry*</option>
                            <?php
                            $query = "SELECT * FROM industry";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <option value=<?php echo $row['id'] ?>>  <?php echo $row['name'] ?> </option>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </select>
                </div>

                <hr>


                <hr>

                <div class="form-outline mb-4">

                    <select class="select w-100" name="size">
                        <div class="selectOption">
                            <option selected disabled>Choose company size*</option>
                            <?php
                            $query = "SELECT * FROM company_size";
                            $result = mysqli_query($con, $query);
                           
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    
                                    <option value=<?php echo $row['id'] ?>><?php echo $row['size'] ?> employees</option>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </select>

                </div>

                <hr>



                <hr>
                <div class="form-outline mb-4">
                    <select class="select w-100" name="type">
                        <div class="selectOption">
                            <option selected disabled>Choose company type*</option>
                            <?php
                            $query = "SELECT * FROM company_type";
                            $result = mysqli_query($con, $query);
                            
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    
                                    <option value=<?php echo $row['id'] ?>><?php echo $row['type'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </select>
                </div>
                <hr>


                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" >Phone Number*</label>
                        <input name="phone" type="number" min="0" class="form-control" placeholder="EX: 019123456789" required>
                    </div>
                    <div class="col">
                        <label class="form-label" >Year Founded*</label>
                        <input name="year" type="number" min="0" class="form-control" placeholder="EX: 2022" required>

                    </div>
                </div>



                <hr>
                <div class="form-outline mb-4">
                    <select class="select w-100" name="location">
                        <div class="selectOption">
                            <option selected disabled>Choose Location*</option>
                            <?php
                            $query = "SELECT * FROM location";
                            $result = mysqli_query($con, $query);
                            
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    
                                    <option value=<?php echo $row['id'] ?>><?php echo $row['location'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </select>
                </div>
                <hr>




                <label for="basic-url" class="form-label">Website (Optional)</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">https://website.com/</span>
                    <input name="website" type="text" class="form-control" id="basic-url1" aria-describedby="basic-addon3" />
                </div>

                <label class="form-label" for="customFile">Upload Company Image</label>
                <input name="picture" type="file" class="form-control"  id="customFile" />

                
                <button type="submit" class="btn btn-dark btn-block mb-4 mt-4">Join</button>
            </form>
        </div> 

    </div>





    <?php include "utility/footer.php" ?>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>