<?php
    session_start();

    include "db.php";

    $bookid = $_GET['id'];

    // Get Today's Date
    date_default_timezone_set('Asia/Dhaka');
    $date = date("Y/m/d");

    $query = mysqli_query($link,"update lent_book_list set returned='Yes', returned_date='$date' WHERE book_id='$bookid' AND returned='No' ");
    
    if(mysqli_query($link, $query) == false)
    {
        $error = "There is a error Inserting Data";
        echo '<script type="text/javascript">alert("' . $error . '")</script>';
        echo mysqli_error($link);
    }

    mysqli_query($link,"update book_list_table set book_status='Available' WHERE book_id=$bookid");


    header('Location: ../lent_book_list.php');
?>