<?php

class Instructor
{

  private $about = "Not Found";
  private $website = "";
  private $facebook = "";
  private $linkedin = "";
  private $twitter = "";
  private $error = "";

  public function valid($data)
  {

    $id = $data['id'];
    $name = $data['name'];
    $headline = $data['headline'];
    $about = $data['about'];
    $teaching_exp = $data['teaching_exp'];
    $course_exp = $data['course_exp'];
    $website = $data['website'];

    if (empty($name)) {
      $this->error = "Instructor name can't be empty";
      return $this->error;
    }

    if (empty($headline)) {
      $this->error = "Headline can't be empty";
      return $this->error;
    }

    $db = new Database();
    $con = $db->connect_db();

    $query = "SELECT * FROM instructor_profile WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
      $this->error = "Instructor already exits";
      return $this->error;
    }
  }

  public function createInstructor($data)
  {
    $error_msg = $this->valid($data);

    if (empty($error_msg)) {

      $id = $data['id'];
      $name = $data['name'];
      $headline = $data['headline'];
      $this->about = $data['about'];
      $teaching_exp = $data['teaching_exp'];
      $course_exp = $data['course_exp'];
      $this->website = $data['website'];
      $is_instructor = true;

      $db = new Database();
      $query1 = "UPDATE user SET is_instructor = $is_instructor WHERE id = $id";
      $db->save($query1);

      $query2 = "INSERT INTO instructor_profile (user_id,instructor_name,headline,about_me,teaching_exp,course_exp,website,facebook,linkedin,twitter) 
                VALUES ('$id','$name','$headline','$this->about','$teaching_exp','$course_exp','$this->website','$this->facebook','$this->linkedin','$this->twitter')";
      $db->save($query2);
      header("location: instructor_dashboard.php");
      $success_msg = "success";

      return $success_msg;
    } else {
      return $error_msg;
    }
  }

  public function findInstructor($user_id){
    $db = new Database();
    $con = $db->connect_db();
    
    $query = "SELECT * FROM instructor_profile WHERE user_id='$user_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        // $ins_id = $row['id'];
        return $row;
    }else{
        return null;
    }
  }
}
