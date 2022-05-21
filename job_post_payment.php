<?php

require_once("models/database.php");
require_once("models/user.php");
require_once("models/employer.php");
require_once("models/job.php");

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

$emp = new Employer();
$job = new Job();
if ($emp->checkIsEmployer($user_id) == false) {
    header("location: no_access.php");
}

$employer = $emp->findEmployerByUserID($user_id);

$data = "";
$location = "";
$job_type = "";
if (isset($_SESSION['JOB'])) {
    $data = $_SESSION['JOB'];
    $location = $job->findLocationById($data['location']);
    $job_type = $job->findJobTypeById($data['type']);
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $job = new Job();
    $job->createJob($data, $user_id);
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

    <?php include "utility/employer_navbar.php" ?>

    <div class="container">
        <div class="mt-4 mb-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="card bg-dark text-light">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-dark marginCard">
                                    <img src="<?php echo $employer['picture'] ?>" alt="" height="130px">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5><?php echo $data['title'] ?></h5>
                                <p><?php echo $employer['company_name'] ?></p>
                                <p><?php echo $location['location'] ?> (<?php echo $job_type['type'] ?>)</p>
                            </div>
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
                                        <input type="text" id="form3Example1" class="form-control" placeholder="MM/YY" required />
                                        <label class="form-label" for="form3Example1">Expiration date</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline">
                                        <input type="text" id="form3Example2" class="form-control" placeholder="CVV" required />
                                        <label class="form-label" for="form3Example2">Security code</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-dark btn-block mb-4">Pay $5</button>
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