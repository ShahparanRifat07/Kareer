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

    public function findTotalUser(){

    }

    public function findLast7DayUser(){
        $db = new Database();
        $con = $db->connect_db();

        
        $query = "SELECT COUNT(id) as userNum,DAY(created_time) as day FROM user
        WHERE created_time > DATE(now()) - INTERVAL 7 day
        GROUP BY DAY(created_time);";
        $result = mysqli_query($con,$query);


        if($result){
            $value = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                        $value += array($row['day'] => $row['userNum']);
                }
            }

            
            return $value;
        }

    }

}
