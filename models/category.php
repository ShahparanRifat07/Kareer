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
}
