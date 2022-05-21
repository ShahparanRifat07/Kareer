<?php

class Employer
{

    public function checkIsEmployer($user_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM employer_profile WHERE user_id='$user_id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function valid($data, $file)
    {

        $error = "";

        $fileType = "";

        if (!isset($data['name'])) {
            $error = "Please enter your company name";
            return $error;
        }

        if (!isset($data['industry'])) {
            $error = "Please choose a industry";
            return $error;
        }

        if (!isset($data['size'])) {
            $error = "Please choose a company size";
            return $error;
        }

        if (!isset($data['type'])) {
            $error = "Please choose a company type";
            return $error;
        }

        if (!isset($data['phone'])) {
            $error = "Please enter your phone number";
            return $error;
        }

        if (!isset($data['year'])) {
            $error = "Please enter founded year";
            return $error;
        }

        if (!isset($data['location'])) {
            $error = "Please enter your location";
            return $error;
        }


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


    public function createEmployer($data, $file, $user_id)
    {

        $error = $this->valid($data, $file);

        if (empty($error)) {
            $id = $user_id;
            $company_name = $data['name'];
            $description = $data['about'];
            $industry = $data['industry'];
            $company_size = $data['size'];
            $company_type = $data['type'];
            $phone = $data['phone'];
            $year_founded = $data['year'];
            $location = $data['location'];
            $website = $data['website'];
            $picture = $file['picture'];
            // echo $id."   ".$company_name."   ".$description."   ".$industry."   ".$company_size."   ".$company_type."    ".$phone."    ".$year_founded."    ".$location."    ".$website;

            $db = new Database();

            $targetDir = "uploads_company_image/";
            $fileName = basename($picture["name"]);
            $filename_without_ext = pathinfo($fileName, PATHINFO_FILENAME);
            $uniquesavename = time() . uniqid(rand());
            $targetFilePath = $targetDir . $filename_without_ext . $company_name . $uniquesavename . ".jpg";

            try {
                $query2 = "INSERT INTO employer_profile (user_id,company_name,description,industry,company_size,company_type,phone,year_founded,location,website,picture) 
                VALUES ('$id','$company_name','$description','$industry','$company_size','$company_type','$phone','$year_founded','$location','$website','$targetFilePath')";

                if ($db->save($query2) == true) {
                    $query1 = "UPDATE user SET is_employer = 1 WHERE id = $id";
                    $db->save($query1);
                    move_uploaded_file($picture["tmp_name"], $targetFilePath);
                    header("location: employer_dashboard.php");
                }
            } catch (mysqli_sql_exception $e) {
                var_dump($e);
                exit;
            }
        } else {
            echo $error;
        }
    }

    public function findEmployerByUserID($user_id)
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT emp.id,emp.user_id, emp.company_name, emp.description,emp.picture, ind.name AS industry_name FROM employer_profile as emp JOIN industry as ind ON emp.industry = ind.id WHERE emp.user_id = '$user_id';";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
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

    public function findTotalJobPost($employer_id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(id) AS total_post 
                    FROM `job` 
                    WHERE employe_id = '$employer_id'";

        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            return $row['total_post'];
        }else{
            echo "0";
        }
    }


    public function findTotalJobApplicants($employer_id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(job_apply.id) AS total_applicants
                    FROM job_apply
                    JOIN job
                    ON job_apply.job_id = job.id
                    JOIN employer_profile
                    ON job.employe_id = employer_profile.id
                    WHERE employer_profile.id = '$employer_id'";

        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            return $row['total_applicants'];
        }else{
            echo "0";
        }
    }


    

    
}
