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
        } else {
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

        if (mysqli_num_rows($result) == 1) {
            header("location: course_details.php?id=$course_id");
        }
    }

    public function checkIfCourseBoughtByUser($course_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = "";
        if ($learner != false) {
            $learner_id = $learner['id'];
        }
        $query = "SELECT * FROM course_transaction WHERE course_id='$course_id' AND learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function checkIfAnyCourseBought($user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = $this->findLearnerByUserID($user_id);
        $learner_id = $learner['id'];
        $query = "SELECT * FROM course_transaction WHERE learner_id='$learner_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function addAbout($data, $learner_id)
    {

        $about = $data['about'];

        $db = new Database();
        $con = $db->connect_db();
        $query = "UPDATE learner_profile SET biography = '$about' WHERE id = '$learner_id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            $query1 = "SELECT user_id FROM learner_profile WHERE id = '$learner_id'";
            $result1 = mysqli_query($con, $query1);
            $row = mysqli_fetch_assoc($result1);
            $user_id = $row['user_id'];
            header("location: profile.php?user_id=$user_id");
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





    public function findTotalPointsOfLearner($learner_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT SUM(con.point) as total_point
                    FROM complete_content as com
                    JOIN content as con
                    ON com.content_id = con.id
                    WHERE learner_id = '$learner_id';";

        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }
    }

    public function valid($file)
    {

        $error = "";
        $fileType = "";

        if (!isset($file['picture'])) {
            $error = "Please choose a photo";
            return $error;
        } else {
            $picture = $file['picture'];
            $targetDir = "uploads_company_image/";
            $fileName = basename($picture["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        }

        $allowTypes = array('jpg', 'png', 'jpeg');
        if (!in_array($fileType, $allowTypes)) {
            $this->error_msg = 'Sorry, only JPG, JPEG, PNG, files are allowed to upload.';
            return $this->error_msg;
        }
    }

    public function UpdateProfilePicture($file, $learner_id, $user_id)
    {

        $error = $this->valid($file);

        if (empty($error)) {
            $picture = $file['picture'];
            $db = new Database();

            $targetDir = "uploads_profile_pic/";
            $fileName = basename($picture["name"]);
            $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
            $uniquesavename = time() . uniqid(rand());
            $targetFilePath = $targetDir . $filename_without_ext . $learner_id . $uniquesavename . ".jpg";

            try {
                $query = "UPDATE learner_profile SET profile_pic = '$targetFilePath' WHERE id = $learner_id";

                if ($db->save($query) == true) {
                    move_uploaded_file($picture["tmp_name"], $targetFilePath);
                    header("location: profile.php?user_id=$user_id");
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        } else {
            echo $error;
        }
    }


    public function findLearnerByLearnerID($learner_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM learner_profile WHERE id='$learner_id'";
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
