<?php


class Course
{
    private $error_msg = "";

    function valid($data, $file)
    {
        $id = $data['id'];
        $title = $data['title'];
        $description = $data['description'];
        $price = $data['price'];
        $picture = $file['picture'];


        $targetDir = "uploads/" . $id . "/" . $title . "/";
        $fileName = basename($picture["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (empty($title)) {
            $this->error_msg = "title can't be empty";
            return $this->error_msg;
        }

        if (!isset($data['category'])) {
            $this->error_msg = "Please select a Category";
            return $this->error_msg;
        }



        if (empty($price)) {
            $this->error_msg = "Price can't be empty";
            return $this->error_msg;
        }

        if (!isset($data['point_needed'])) {
            $this->error_msg = "Please enter the total point needed to complete this course";
            return $this->error_msg;
        }

        if (empty($fileName)) {
            $this->error_msg = "Please choose a picture";
            return $this->error_msg;
        }

        $allowTypes = array('jpg', 'png', 'jpeg');
        if (!in_array($fileType, $allowTypes)) {
            $this->error_msg = 'Sorry, only JPG, JPEG, PNG, files are allowed to upload.';
            return $this->error_msg;
        }
    }

    function extractYoutubeCode($YoutubeCode)
    {
        $url_parsed_arr = parse_url($YoutubeCode);
        if ($url_parsed_arr['host'] == "www.youtube.com" || $url_parsed_arr['host'] == "youtu.be") {
            preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $YoutubeCode, $matches);
            if (isset($matches[2]) && $matches[2] != '') {
                $YoutubeCode = $matches[2];
                return $YoutubeCode;
            }
        } else {
            return null;
        }
    }


    function createCourse($data, $file)
    {
        $error = $this->valid($data, $file);

        if (empty($error)) {
            $id = $data['id'];
            $title = $data['title'];
            $description = $data['description'];
            $category = $data['category'];
            $price = $data['price'];
            $point_needed = $data['point_needed'];
            $picture = $file['picture'];





            if (isset($data["submit"])) {
                $db = new Database();
                $con = $db->connect_db();
                $query = "SELECT id FROM instructor_profile WHERE user_id='$id'";
                $result = mysqli_query($con, $query);
                $ins_id = "";

                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);
                    $ins_id = $row['id'];
                } else {
                    $error = "Something went worng";
                    return $error;
                }


                $targetDir = "uploads/";
                $fileName = basename($picture["name"]);
                $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
                $uniquesavename = time() . uniqid(rand());
                $targetFilePath = $targetDir . $filename_without_ext . $ins_id . $title . $uniquesavename . ".jpg";

                // echo $fileName;

                // echo $ins_id."   ". $title ."   ". $description ."  ". $category . "   ". $price . "  ". $targetFilePath;

                try {
                    $query = "INSERT INTO course (instructor_id,title,description,category_id,price,picture,point_needed)
                    VALUES ('$ins_id','$title','$description','$category','$price','$targetFilePath','$point_needed')";

                    if ($db->save($query) == true) {
                        move_uploaded_file($picture["tmp_name"], $targetFilePath);
                    } else {
                        $error = "Something went wrong";
                        return $error;
                    }
                    header("location: instructor_dashboard.php");
                } catch (mysqli_sql_exception $e) {
                    var_dump($e);
                    exit;
                }
            } else {
                $error = "Something went wrong";
                return $error;
            }
        } else {
            echo $error;
            return $error;
        }
    }


    public function findCourseById($id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM course WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return null;
        }
    }

    public function findStatus($course)
    {
        $status = "";

        if ($course['is_drafted'] == 1) {
            $status = "Drafted";
        }
        if ($course['is_submitted'] == 1) {
            $status = "Submitted";
        }
        if ($course['is_approved'] == 1) {
            $status = "Approved";
        }

        return $status;
    }

    public function addSection($data, $course_id)
    {
        $course_name = $data['name'];

        if (isset($data["submit"])) {

            $query = "INSERT into section (course_id,name) values('$course_id','$course_name')";
            $db = new Database();
            $db->save($query);
            header("Refresh:0");
        }
    }

    public function isCourseByInstructorId($id, $course_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM course WHERE id='$course_id' AND instructor_id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            if ($row['id'] == $course_id) {
                return true;
                // echo $row['id'] . "    ".$course_id;
            } else {
                // echo "false";
                return false;
            }
        } else {
            return null;
        }
    }


    public function addContentToSection($data, $section_id, $course_id)
    {

        if (isset($data["submit"])) {
            $error = "";
            $title = $data['title'];
            $description = $data['description'];
            $point = $data['point'];
            $url = $this->extractYoutubeCode($data['url']);
            $preview = 1;
            if (!isset($data['preview'])) {
                $preview = 0;
            }
            if ($url == null) {
                $error = "Enter a valid youtube link";
                return $error;
            } else {

                $query = "INSERT into content (section_id,name,description,url,is_preview,point) 
                values('$section_id','$title','$description','$url','$preview','$point')";
                $db = new Database();
                $db->save($query);
            }
            // echo $title . "-------" . $description . " ----- " . $url . "-------" . $preview;

        }
    }


    public function approveCourse($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM course WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $created_time = $row['created_time'];
            $query1 = "UPDATE course SET created_time='$created_time', is_approved=1, is_drafted=0,is_submitted=0 WHERE id='$id'";
            $db->save($query1);
            header("location: admin_course.php");
        }
    }

    public function unlinkFile($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM course WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            unlink($row['picture']);
        }
    }

    public function deleteCourse($id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $this->unlinkFile($id);
        $query = "DELETE FROM course WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("location: admin_course.php");
        }
    }

    public function submitCourse($id)
    {

        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM course WHERE id='$id'";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // $created_time = $row['created_time'];
            $query1 = "UPDATE course SET is_submitted=1 WHERE id='$id'";
            $db->save($query1);
            header("location: course_details.php?id=" . $id);
        }
    }

    public function insertCourseView($course_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "INSERT INTO course_view (course_id) VALUES ('$course_id')";
        $result = mysqli_query($con, $query);
    }

    public function isPreviewActive($content_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM content WHERE id='$content_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['is_preview'] == true) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function findCurrentCoursePoint($course_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT SUM(point) AS total_point 
                    FROM content AS con
                    JOIN section AS sec
                    ON con.section_id = sec.id
                    JOIN course AS cor
                    ON sec.course_id = cor.id
                    WHERE cor.id = '$course_id';";

        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row['total_point'];
        } else {
            return null;
        }
    }


    public function completeCourseContent($content_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $learner = new Learner();
        $learner_object = $learner->findLearnerByUserID($user_id);
        $learner_id = $learner_object['id'];
        if ($learner_id != null) {
            $query = "INSERT INTO complete_content (learner_id,content_id) VALUES ('$learner_id','$content_id')";
            $result = mysqli_query($con, $query);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function checkIfContentComplete($content_id, $user_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $learner = new Learner();
        $learner_object = $learner->findLearnerByUserID($user_id);
        $learner_id = $learner_object['id'];

        if ($learner_id != null) {
            $query = "SELECT * FROM complete_content WHERE learner_id='$learner_id' AND content_id='$content_id'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function findHowManyPointsCompleted($course_id, $learner_id)
    {
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT SUM(con.point) AS completed_point
                    FROM complete_content as complete
                    JOIN content as con
                    ON complete.content_id = con.id
                    JOIN section as sec
                    ON con.section_id = sec.id
                    JOIN course as cor
                    ON sec.course_id = cor.id
                    WHERE complete.learner_id = '$learner_id' AND cor.id='$course_id';";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            return $row['completed_point'];
        }
    }

    public function checkIfTheCourseIsComplete($course_id, $learner_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT SUM(con.point) AS total_points, complete.learner_id as learner_id, user.id as user_id,learner_profile.profile_pic,user.first_name,user.last_name,cor.point_needed
                    FROM complete_content as complete
                    LEFT JOIN content as con
                    ON complete.content_id = con.id
                    JOIN section as sec
                    ON con.section_id = sec.id
                    JOIN course as cor
                    ON sec.course_id = cor.id
                    LEFT JOIN learner_profile
                    ON complete.learner_id = learner_profile.id
                    JOIN user
                    ON learner_profile.user_id = user.id
                    WHERE complete.learner_id='$learner_id' AND cor.id='$course_id'";

        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['total_points'] >= $row['point_needed']) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function rateCourse($data,$course_id,$learner_id){
        $rating = $data['rate'];
        $db = new Database();
        $con = $db->connect_db();
        $query =  "INSERT INTO course_rating (course_id,learner_id,rating)
                    VALUES('$course_id','$learner_id','$rating');";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("location: course_details.php?id=$course_id");
        }
    }

    public function checkIfCourseRatedByTheLearner($course_id,$learner_id){
        $db = new Database();
        $con = $db->connect_db();
        $query =  "SELECT * FROM course_rating WHERE course_id='$course_id' AND learner_id='$learner_id' ;";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        }else{
            return false;
        }
    }
}
