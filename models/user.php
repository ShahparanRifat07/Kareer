<?php


class User
{

    private $is_learner = false;
    private $is_instructor = false;
    private $is_employer = false;
    private $is_admin = false;

    private $error = "";

    private $login = false;

    public function valid($data)
    {

        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];

        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if (empty($first_name)) {
            $this->error = "First name can't be empty";
            // echo "email error";
            return $this->error;
        }

        if (empty($last_name)) {
            $this->error = "Last name can't be empty";
            // echo "email error";
            return $this->error;
        }

        if (mysqli_num_rows($result) > 0) {
            $this->error = "Account already exists with this email";
            // echo "email error";
            return $this->error;
        }

        if (strlen($password) < 6) {
            $this->error = "Password must be at least 6 digits";
            // echo "password error";
            return $this->error;
        }
    }

    public function createUser($data)
    {
        $error_msg = $this->valid($data);

        if ($error_msg == "") {

            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email = $data['email'];
            $password = $data['password'];
            $this->is_learner = true;
            $hash_password = sha1($password);
            $query = "INSERT into user (first_name,last_name,email,password,is_learner,is_instructor,is_employer,is_admin) 
                values('$first_name','$last_name','$email','$hash_password','$this->is_learner','$this->is_instructor','$this->is_employer','$this->is_admin')";
            $db = new Database();
            $db->save($query);
            $learner = new Learner();
            $learner->createLearnerProfile($data);
            $success_msg = "success";
            return $success_msg;
        } else {
            return $error_msg;
        }
    }


    public function loginUser($data)
    {

        $db = new Database();
        $con = $db->connect_db();
        $email = $data['email'];
        $password = $data['password'];
        $hash_password = sha1($password);
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);

            // print_r($row);
            $password = $row['password'];
            if ($password == $hash_password) {
                $login = true;
                $user_id = $row['id'];
                session_start();
                $_SESSION['USERID'] = $user_id;
                $_SESSION['LOGGEDIN'] = true;
                header("location: index.php");
            } else {
                $this->error = "Login Failed: Your email or password is incorrect";
                return $this->error;
            }
        } else {
            $this->error = "Login Failed: Your email or password is incorrect";
            return $this->error;
        }
    }


    public function findUserByUserId($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }else{
            return null;
        }
    }

    public function checkIFAdmin($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['is_admin'] == 1) {
                return true;
            }
        }
    }


    public function addExperience($data, $user_id)
    {

        $title = $data['title'];
        $company_name = $data['company'];
        $type = $data['type'];
        $start = $data['start'];
        $end = $data['end'];
        $location = $data['location'];

        $db = new Database();
        $con = $db->connect_db();
        $query = "INSERT INTO experience (user_id,company_name,job_title,job_type,start_time,end_time,location)
            VALUES('$user_id','$company_name','$title','$type','$start','$end','$location');";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("location: profile.php?user_id=$user_id");
        }
    }


    public function addEducation($data, $user_id)
    {

        $school = $data['school'];
        $degree = $data['degree'];
        $field = $data['field'];
        $start = $data['start'];
        $end = $data['end'];

        $db = new Database();
        $con = $db->connect_db();
        $query = "INSERT INTO education (user_id,school,degree,field,start_time,end_time)
            VALUES('$user_id','$school','$degree','$field','$start','$end');";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("location: profile.php?user_id=$user_id");
        }
    }

    public function findEducation($user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM education WHERE user_id = '$user_id' ORDER BY end_time DESC";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }


    public function addSkills($data, $user_id)
    {

        $skill = $data['skill'];

        $db = new Database();
        $con = $db->connect_db();
        $query =  "INSERT INTO skill (user_id,skill)
        VALUES('$user_id','$skill');";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("location: profile.php?user_id=$user_id");
        }
    }

    public function addProject($data, $user_id)
    {

        $name = $data['name'];
        $about = $data['about'];
        $start = $data['start'];
        $end = $data['end'];
        $url = $data['url'];


        $db = new Database();
        $con = $db->connect_db();
        $query = "INSERT INTO project (user_id,name,about,start_time,end_time,url)
            VALUES('$user_id','$name','$about','$start','$end','$url');";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("location: profile.php?user_id=$user_id");
        }
    }

    public function findUserByLearnerID($learner_id){
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT 
                (
                    SELECT user.first_name
                    FROM user
                    WHERE user.id = learner_profile.user_id
                ) AS first_name,
                (
                    SELECT user.last_name
                    FROM user
                    WHERE user.id = learner_profile.user_id
                )AS last_name,
                (
                    SELECT user.email
                    FROM user
                    WHERE user.id = learner_profile.user_id
                )AS email
                FROM `learner_profile` 
                WHERE id = '$learner_id'";


        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            // $ins_id = $row['id'];
            return $row;
        } else {
            return false;
        }
    }
}
