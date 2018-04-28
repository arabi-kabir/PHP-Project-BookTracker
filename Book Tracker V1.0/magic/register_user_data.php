<?php
    session_start();
    
    include "db.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Same username exists.
        $query = "SELECT * FROM user_table WHERE user_name = '".$username."' ";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result);

        if(mysqli_num_rows ($result) > 0)
        { 
            $_SESSION["same_user_exist"] = "yes"; 
            header('Location: ../register_user.php');       
        }
        else
        {
            // If same username not exists then insert user.
            $query = "insert into `user_table` (`user_name`, `user_password`, `user_email`) values ('$username', '$password', '$email')";
            if(mysqli_query($link, $query) == false)
            {
                $error = "There is a error inserting User Data.";
                echo '<script type="text/javascript">alert("' . $error . '")</script>';
            }
            header('Location: ../index.php');
        }
    }

?>