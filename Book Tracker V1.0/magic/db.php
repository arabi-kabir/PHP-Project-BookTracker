<?php
    $link = mysqli_connect("Localhost", "root", "", "booktracker");

    if(mysqli_connect_error() == true)
    {
        die("Database connection error.");
    }
?>