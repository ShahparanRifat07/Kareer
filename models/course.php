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
            $picture = $file['picture'];



            // echo $ins_id."   ". $title ."   ". $description ."  ". $category . "   ". $price . "  ". $targetFilePath;

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

                $query = "INSERT INTO course (instructor_id,title,description,category_id,price,picture)
                VALUES ('$ins_id','$title','$description','$category','$price','$targetFilePath')";

                if ($db->save($query) == true) {
                    move_uploaded_file($picture["tmp_name"], $targetFilePath);
                } else {
                    $error = "Something went wrong";
                    return $error;
                }
                header("location: instructor_dashboard.php");
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

            // echo "null";
            return null;
        }
    }


    public function addContentToSection($data, $section_id,$course_id)
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


    public function approveCourse($id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM course WHERE id='$id'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $created_time = $row['created_time'];
            $query1 = "UPDATE course SET created_time='$created_time', is_approved=1, is_drafted=0,is_submitted=0 WHERE id='$id'";
            $db->save($query1);
            header("location: admin_course.php");
        }
    }

    public function deleteCourse($id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "DELETE FROM course WHERE id='$id'";
        $result = mysqli_query($con,$query);

        if($result){
            header("location: admin_course.php");
        }
    }


}
