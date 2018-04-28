<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include "db.php";
        // Get Today's Date
        date_default_timezone_set('Asia/Dhaka');
        $date = date("Y/m/d");

        if(isset($_POST['submitBtn']))
        {
            $book_name =  $_POST['book_name'];
            $book_type = $_POST['book_type'];
            $book_author = $_POST['book_author'];
            $book_owner_id = $_POST['owner_id'];
            
            $query = "INSERT into book_list_table (book_name, book_author, book_status, book_owner_user_id, book_added_date, book_type) values ('$book_name', '$book_author', 'Available', '$book_owner_id', '$date', '$book_type')";
            
            if(mysqli_query($link, $query) == false)
            {
                $error = "There is a error Inserting Data";
                echo '<script type="text/javascript">alert("' . $error . '")</script>';
                echo mysqli_error($link);
            }

            header('Location: ../home.php');
        }
    }

?>