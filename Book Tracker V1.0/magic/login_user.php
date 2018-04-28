<?php
    session_start();

    include "db.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $query = "SELECT * FROM user_table WHERE user_name = '".$username."' AND user_password = '".$password."' ";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);

        if(mysqli_num_rows ($result) > 0)
        {
            $_SESSION["user_id"] =   $row['user_id'];
            $_SESSION["user_name"] = $row['user_name'];
            
            header('Location: ../home.php');          
        }
        else
        {
            $_SESSION["user_not_found"] = "yes";         
            header('Location: ../index.php');
        }
    }
?>