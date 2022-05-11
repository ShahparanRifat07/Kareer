<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/instructor.php");
// require_once("$rootDir/Kareer/instructor/dashboard.php");

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
            <a href="admin_dashboard.php" class="navbar-brand mt-2 mt-lg-0" href="#">
                <!-- <img src="img/logo.svg" height="15" alt="MDB Logo" loading="lazy" /> -->
                <h3>Kareer Administrator</h3>
            </a>
            <!-- Left links -->
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="create_course.php">Create Course</a>
                </li>
            </ul> -->
            <!-- Left links -->

        </div>
        <!-- Collapsible wrapper -->



        <!-- <form class="d-flex input-group w-80 w-auto ">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
                <i class="fas fa-search"></i>
            </span>
        </form> -->

        <!-- Right elements -->
        <div class="d-flex align-items-center">
            <!-- Icon -->
            <!-- <a class="text-reset me-3" href="#">
                <i class="fas fa-shopping-cart"></i>
            </a> -->

            <!-- Notifications -->
            <!-- <div class="dropdown">
                <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="#">Some news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Another news</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </li>
                </ul>
            </div> -->



            <?php
            if (isset($_SESSION['LOGGEDIN'])) {
            ?>
                <a class="text-reset me-3" href="index.php">
                    Homepage
                </a>


                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $profile_pic ?>" class="rounded-circle" height="25" alt="Profile Pic" loading="lazy" />
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
                            <a class="dropdown-item" href="#">Draft Courses</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Published Courses</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">All Courses</a>
                        </li>
                        <hr>
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