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
                }else{
                    $error = "Something went worng";
                    return $error;
                }
                

                $targetDir = "uploads/";
                $fileName = basename($picture["name"]);
                $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
                $uniquesavename=time().uniqid(rand());
                $targetFilePath = $targetDir . $filename_without_ext.$ins_id.$title.$uniquesavename.".jpg";

                // echo $fileName;

                $query = "INSERT INTO course (instructor_id,title,description,categoty_id,price,picture)
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
}
