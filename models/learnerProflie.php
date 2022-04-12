<?php

class Learner
{

    private $biography = "No Biography";
    private $dob = NULL;
    private $city = "";
    private $country = "";
    private $profile_pic = "img/defult.jpg";

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
}
