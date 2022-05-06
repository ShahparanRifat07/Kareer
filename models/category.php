<?php


class Category
{

    function getAllCategories()
    {
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM category";
        $result = mysqli_query($con, $query);
        return $result;
    }

    public function findCategoryById($id){
        $db = new Database();
        $con = $db->connect_db();

        $query = "SELECT * FROM category WHERE id='$id'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            return $row;
        } else {
            return null;
        }
    }
}
