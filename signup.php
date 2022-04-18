<?php

require('models/database.php');
require('models/user.php');
require('models/learnerProflie.php');

$result = NULL;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $result = $user->createUser($_POST);
}

session_start();
if (isset($_SESSION["LOGGEDIN"])) {
    header("location: index.php");
} 

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/auth.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <?php include "utility/navbar.php" ?>


    <div class="form-section">

        <div class="card" style="width: 40rem;">


            <!-- error or success message -->
            <?php
            if ($result == "success") {
            ?>
                <div class="succesmsg">
                    <p>Account is created. Please Login</p>
                </div>
            <?php
            } else if ($result != "") {
            ?>
                <div class="warning">
                    <p><?php echo $result ?></p>
                </div>

            <?php
            }
            ?>



            <form method="post" action="">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <input name="first_name" type="text" id="form3Example1" class="form-control" required />
                            <label class="form-label" for="form3Example1">First name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <input name="last_name" type="text" id="form3Example2" class="form-control" required />
                            <label class="form-label" for="form3Example2">Last name</label>
                        </div>
                    </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input name="email" type="email" id="form3Example3" class="form-control" required />
                    <label class="form-label" for="form3Example3">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input name="password" type="password" id="form3Example4" class="form-control" required />
                    <label class="form-label" for="form3Example4">Password</label>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-dark btn-block mb-4">Sign Up</button>
            </form>
        </div>
    </div>

    <?php include "utility/footer.php" ?>





    <script type="text/javascript" src="js/main.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"></script>
</body>

</html>