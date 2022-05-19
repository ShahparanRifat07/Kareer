<?php
$rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

require_once("models/database.php");
require_once("models/user.php");
require_once("models/learnerProflie.php");
require_once("models/category.php");
// require_once("$rootDir/Kareer/instructor/dashboard.php");



if (isset($_SESSION['LOGGEDIN']) && isset($_SESSION['USERID'])) {
    $db1 = new Database();
    $con = $db1->connect_db();

    $id = $_SESSION["USERID"];
    $first_name = "";
    $last_name = "";
    $email = "";
    $is_learner = false;
    $is_instructor = false;
    $is_employer = false;
    $is_admin = false;
    $profile_pic = "";

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
            <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
                <!-- <img src="img/logo.svg" height="15" alt="MDB Logo" loading="lazy" /> -->
                <h3>Kareer</h3>
            </a>
            <!-- Left links -->
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>
            </ul> -->
            <!-- Left links -->
            <ul class="navbar-nav">
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        $cat = new Category();
                        $cat_result = $cat->getAllCategories();
                        if ($cat_result->num_rows > 0) {
                            while ($row = $cat_result->fetch_assoc()) {

                        ?>
                                <li>
                                    <a class="dropdown-item" href="course_category.php?category_id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li>
                                <a href=""></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="#">Ranking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_job.php"><span><i class="fa-solid fa-briefcase"></i> Jobs</a>
                </li>
            </ul>
            <div class="col-md-8 ms-3">
                <form class="d-flex input-group w-auto my-auto ">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </form>
            </div>
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
                <?php
                if ($is_admin == true) {
                ?>
                    <a class="text-reset me-3" href="admin_dashboard.php">
                        <span><i class="fa-solid fa-user"></i></span>
                        Admin
                    </a>
                <?php
                }
                ?>

                <?php
                if ($is_employer == true) {
                ?>
                    <a class="text-reset me-3" href="employer_dashboard.php">
                        <span><i class="fa-brands fa-black-tie"></i></span>
                        Employer
                    </a>
                <?php
                }
                ?>

                <?php
                if ($is_instructor == true) {
                ?>
                    <a class="text-reset me-3" href="instructor_dashboard.php">
                        <span><i class="fa-solid fa-book-open-reader"></i></span>
                        Instructor
                    </a>
                <?php
                }
                ?>

                
                <!-- Avatar -->
                <div class="dropdown">
                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $profile_pic ?>" class="rounded-circle" height="25" width="25" alt="Profile Pic" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">

                        <li>
                            <div id="profile-head">
                                <p><strong><?php echo $first_name . " " . $last_name ?></strong></p>
                                <p><span><?php echo $email ?></p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">My Courses</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Wishlist</a>
                        </li>
                        <hr>
                        <?php
                        if ($is_instructor == false) {
                        ?>
                            <li>
                                <a class="dropdown-item" href="become_instructor.php">Become an Instructor</a>
                            </li>
                            <hr>
                        <?php
                        } else {
                        ?>
                            <li>
                                <a class="dropdown-item" href="instructor_dashboard.php">Instructor Dashboard</a>
                            </li>
                            <hr>
                        <?php
                        }
                        ?>


                        <?php
                        if ($is_employer == false) {
                        ?>
                            <li>
                                <a class="dropdown-item" href="become_employer.php">Become an Employer</a>
                            </li>
                            <hr>
                        <?php
                        } else {
                        ?>
                            <li>
                                <a class="dropdown-item" href="employer_dashboard.php">Employer Dashboard</a>
                            </li>
                            <hr>
                        <?php
                        }
                        ?>






                        <li>
                            <a class="dropdown-item" href="profile.php?user_id=<?php echo $id ?>">Public Profile</a>
                        </li>
                        <hr>
                        <li>
                            <a class="dropdown-item" href="#">Purchase history</a>
                        </li>
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