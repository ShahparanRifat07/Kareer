<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");
require_once("models/learnerProflie.php");


if (isset($_SESSION['LOGGEDIN']) && isset($_SESSION['USERID'])) {

    $id = $_SESSION["USERID"];
    $first_name = "";
    $last_name = "";
    $email = "";
    $is_learner = false;
    $is_instructor = false;
    $is_employer = false;
    $is_admin = false;
    $profile_pic = "";


    $db1 = new Database();
    $con = $db1->connect_db();
    $query = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $is_learner = $row['is_learner'];
        $is_instructor = $row['is_instructor'];
        $is_employer = $row['is_employer'];
        $is_admin = $row['is_admin'];

        $query = "SELECT * FROM learner_profile WHERE user_id = '$id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $profile_pic = $row["profile_pic"];
            // $profile_pic = "$rootDir/Kareer/$profile";
        }
    }
}


?>



<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a href="employer_dashboard.php" class="navbar-brand mt-2 mt-lg-0" href="#">
                <!-- <img src="img/logo.svg" height="15" alt="MDB Logo" loading="lazy" /> -->
                <h3>Kareer</h3>
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    
                    <a class="nav-link" href="create_job.php"><span><i class="fa-solid fa-briefcase"></i> Post Job</a>
                </li>
            </ul>
            <!-- Left links -->

        </div>

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <?php
            if (isset($_SESSION['LOGGEDIN'])) {
            ?>
                <a class="text-reset me-3" href="index.php">
                    <span><i class="fa-solid fa-graduation-cap"></i></span>
                    Student
                </a>


                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $profile_pic ?>" class="rounded-circle" height="25" width="25" alt="Profile Pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">Public Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Edit Profile</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="#">Company Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Posted jobs</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>

            <?php
            } else {
            ?>

                <a href="login.php" role="button" class="btn btn-light btn-sm m-1" data-mdb-ripple-color="dark">Log In</a>
                <a href="signup.php" role="button" class="btn btn-dark btn-sm">Sign Up</a>
            <?php
            }
            ?>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->