<?php

class Admin{

    function is_admin($id){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT * FROM user WHERE id='$id'";
        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $is_admin = $row['is_admin'];
            if($is_admin == 1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}

?>