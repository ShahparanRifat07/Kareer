<?php

class Job
{
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

            echo $id . "   " . $title . "   " . $description . "   " . $type . "   " . $schedule . "   " . $people . "    " . $maximum . "    " . $minimum . "    " . $location;

            $db = new Database();
            $con = $db->connect_db();
            $emp = new Employer();
            $employer = $emp->findEmployerByUserID($user_id);
            $employe_id = $employer['id'];

            try {
                $query = "INSERT INTO job (employe_id,title,description,type,schedule,people,minimum,maximum,location) 
                VALUES ('$employe_id','$title','$description','$type','$schedule','$people','$minimum','$maximum','$location')";
                $result = mysqli_query($con, $query);
                $job_id = mysqli_insert_id($con);

                if ($result) {
                    $this->buyCourse($job_id, $employe_id);
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        } else {
            echo $error;
        }
    }


    public function findLocationById($location_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM location WHERE id = '$location_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }

    public function findJobTypeById($type_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM job_type WHERE id = '$type_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function findJobDetailsByJobID($job_id)
    {

        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT job.id,job.employe_id,job.title,job.created_time,emp.company_name,job_type.type,location.location,emp.picture,job.minimum,job.maximum,job.description,job_schedule.schedule,job.people,industry.name,emp.website,company_size.size
                    FROM job
                    JOIN employer_profile AS emp
                    ON job.employe_id = emp.id
                    JOIN job_type
                    ON job.type = job_type.id
                    JOIN location
                    ON job.location = location.id
                    JOIN job_schedule
                    ON job.schedule = job_schedule.id
                    JOIN industry
                    ON emp.industry = industry.id
                    JOIN company_size
                    ON emp.company_size = company_size.id
                    WHERE job.id = '$job_id'";

        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        }
    }

    public function checkIfAlreadyApplyToJob($job_id,$learner_id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM job_apply WHERE job_id='$job_id' AND learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            return true;
        }else{
            return false;
        }

    }

    public function applyToJob($job_id,$learner_id){
        $db = new Database();
        $con = $db->connect_db();

        if($this->checkIfAlreadyApplyToJob($job_id,$learner_id) == false){
            $query = "INSERT INTO job_apply (learner_id, job_id)
                    VALUES ('$learner_id', '$job_id')";
            $result = mysqli_query($con, $query);
            if($result){
                header("location: job_details.php?job_id=$job_id");
            }
        }else{
            echo "You already applied to this job";
        }
    }

    public function checkIfJobPostOwnsByTheCurrentUser($user_id,$job_id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * 
                    FROM job
                    JOIN employer_profile
                    ON job.employe_id = employer_profile.id
                    LEFT JOIN user
                    ON employer_profile.user_id = user.id
                    WHERE user.id = '$user_id' AND job.id = '$job_id'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1){
            return true;
        }else{
            return false;
        }
    }



    public function callLearnerForInterview($data,$learner_id,$job_id){
        $date = $data['date'];
        $meeting_link = $data['link'];
        $db = new Database();
        $con = $db->connect_db();
        $query = "UPDATE job_apply SET job_call = 1, meeting_time = '$date',meet_link = '$meeting_link' WHERE learner_id = '$learner_id' AND job_id = '$job_id'";
        $result = mysqli_query($con, $query);

        if($result){
            header("location: show_job_applicants.php?job_id=$job_id");
        }
    }

    public function checkIfLearnerIsCalled($learner_id,$job_id){

        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM job_apply WHERE learner_id = '$learner_id' AND job_id = '$job_id'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['job_call'] == true){
                return true;
            }else{
                return false;
            }
        }
    }
}
