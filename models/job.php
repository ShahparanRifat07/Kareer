<?php

class Job{
    public function valid($data)
    {

        $error = "";


        if (!isset($data['title'])) {
            $error = "Please enter a job title";
            return $error;
        }

        if (!isset($data['description'])) {
            $error = "Please write a job description";
            return $error;
        }

        if (!isset($data['type'])) {
            $error = "Please choose a job type";
            return $error;
        }

        if (!isset($data['schedule'])) {
            $error = "Please choose a job schedule";
            return $error;
        }

        if (!isset($data['people'])) {
            $error = "Please enter number of people you want to hire";
            return $error;
        }

        if (!isset($data['minimum'])) {
            $error = "Please enter the minimum salary range";
            return $error;
        }

        if (!isset($data['maximum'])) {
            $error = "Please enter the maximum salary range";
            return $error;
        }

        if (!isset($data['location'])) {
            $error = "Please enter your location";
            return $error;
        }
    }

    function generate_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0C2f) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0x2Aff),
            mt_rand(0, 0xffD3),
            mt_rand(0, 0xff4B)
        );
    }

    public function buyCourse($job_id, $employe_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        
        $transaction_id = $this->generate_uuid();
        $query = "INSERT INTO job_transaction (job_id,employe_id,transaction_id)
            VALUES ('$job_id','$employe_id','$transaction_id')";
        $result = mysqli_query($con, $query);

        if ($result) {
            unset($_SESSION['JOB']);
            // header("location: job_details.php?id=$job_id");
            header("location: employer_dashboard.php");
        }
    }


    public function createJob($data, $user_id)
    {

        $error = $this->valid($data);

        if (empty($error)) {
            $id = $user_id;
            $title = $data['title'];
            $description = $data['description'];
            $type = $data['type'];
            $schedule = $data['schedule'];
            $people = $data['people'];
            $minimum = $data['minimum'];
            $maximum = $data['maximum'];
            $location = $data['location'];

            echo $id."   ".$title."   ".$description."   ".$type."   ".$schedule."   ".$people."    ".$maximum."    ".$minimum."    ".$location;

            $db = new Database();
            $con = $db->connect_db();
            $emp = new Employer();
            $employer = $emp->findEmployerByUserID($user_id);
            $employe_id = $employer['id'];

            try {
                $query = "INSERT INTO job (employe_id,title,description,type,schedule,people,minimum,maximum,location) 
                VALUES ('$employe_id','$title','$description','$type','$schedule','$people','$minimum','$maximum','$location')";
                $result = mysqli_query($con,$query);
                $job_id = mysqli_insert_id($con);

                if ($result) {
                    $this->buyCourse($job_id,$employe_id);
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        } else {
            echo $error;
        }
    }


    public function findLocationById($location_id){
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM location WHERE id = '$location_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }

    public function findJobTypeById($type_id){
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM job_type WHERE id = '$type_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }



}
