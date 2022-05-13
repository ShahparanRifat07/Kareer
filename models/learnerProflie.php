<?php

class Learner
{

    private $biography = "No Biography";
    private $dob = NULL;
    private $city = "";
    private $country = "";
    private $profile_pic = "img/defult.jpg";

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

    public function createLearnerProfile($data)
    {
        $db = new Database();
        $con = $db->connect_db();
        $email = $data['email'];
        $query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $userId = $row['id'];
            $is_learner = $row['is_learner'];
            // echo $is_learner;
            if ($is_learner == true) {
                $query = "INSERT INTO learner_profile ( user_id, biography, dob, city, country,profile_pic ) 
                VALUES ('$userId','$this->biography','$this->dob','$this->city','$this->country','$this->profile_pic')";
                $db->save($query);
            }
        } else {
            echo "error at Learner.php";
        }
    }

    public function findLearnerByUserID($id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM learner_profile WHERE user_id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            // $ins_id = $row['id'];
            return $row;
        }else{
            return false;
        }
    }

    public function buyCourse($course_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = $learner['id'];
        $transaction_id = $this->generate_uuid();
        $query = "INSERT INTO course_transaction (course_id,learner_id,transaction_id)
            VALUES ('$course_id','$learner_id','$transaction_id')";
        $result = mysqli_query($con, $query);

        if ($result) {
            header("location: course_details.php?id=$course_id");
        }
    }

    public function checkIfCourseBought($course_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = $learner['id'];
        $query = "SELECT * FROM course_transaction WHERE course_id='$course_id' AND learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1){
            header("location: course_details.php?id=$course_id");
        }
    }

    public function checkIfCourseBoughtByUser($course_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = "";
        if($learner!= false){
            $learner_id = $learner['id'];
        }
        $query = "SELECT * FROM course_transaction WHERE course_id='$course_id' AND learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1){
            return true;
        }else{
            return false;
        }
    }
    public function checkIfAnyCourseBought($user_id){
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = $learner['id'];
        $query = "SELECT * FROM course_transaction WHERE learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }
}
