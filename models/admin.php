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
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(id) as total_user FROM `user`";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            return $row['total_user'];
        }else{
            echo "NO USER";
        }

    }

    public function findTotalRevenue(){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT SUM(course.price)+(
            SELECT COUNT(id)*5
            FROM job_transaction
            ) as revenue
            FROM course_transaction
            JOIN course
            ON course_transaction.course_id = course.id";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            return $row['revenue'];
        }else{
            echo "0 revenue";
        }
    }


    public function findTotalCourses(){
        $db = new Database();
        $con = $db->connect_db();
        $query = "SELECT COUNT(id) as total_course FROM course ";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            return $row['total_course'];
        }else{
            echo "NO USER";
        }
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

    public function findLast30daysRevenue(){
        $db = new Database();
        $con = $db->connect_db();

        
        $query = "SELECT SUM(course.price) as revenue,DAY(course_transaction.transaction_time) as dates
                    FROM course_transaction
                    JOIN course
                    ON course_transaction.course_id = course.id
                    GROUP BY course_transaction.transaction_time";
        $result = mysqli_query($con,$query);


        if($result){
            $value = array();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                        $value += array($row['dates'] => $row['revenue']);
                }
            }
            return $value;
        }

    }



}
