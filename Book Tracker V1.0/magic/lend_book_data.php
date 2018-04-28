<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        include "db.php";

        if(isset($_POST['submitBtn']))
        {
            $book_id = $_POST['book_id'];
            $lent_to_name =  $_POST['lend_to'];
            $expected_date_of_return = $_POST['expected_return_date'];
            $book_owner_id = $_POST['owner_id'];
            
            $query = "INSERT into lent_book_list (book_id, lent_to_name, expected_date_of_return, book_owner_id, returned) values ('$book_id', '$lent_to_name', '$expected_date_of_return', '$book_owner_id', 'No')";
            
            $query2 = "update book_list_table set book_status='Lent' WHERE book_id=$book_id";


            if(mysqli_query($link, $query) == false)
            {
                $error = "There is a error Inserting Data";
                echo '<script type="text/javascript">alert("' . $error . '")</script>';
                echo mysqli_error($link);
            }

            if(mysqli_query($link, $query2) == false)
            {
                $error = "There is a error Inserting Data";
                echo '<script type="text/javascript">alert("' . $error . '")</script>';
                echo mysqli_error($link);
            }

            header('Location: ../lent_book_list.php');
        }
    }

?>