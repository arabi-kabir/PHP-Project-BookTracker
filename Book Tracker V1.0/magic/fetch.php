<?php

    include "db.php";
    $output = '';
    if(isset($_POST["query"]))
    {
        $search = mysqli_real_escape_string($link, $_POST["query"]);
        $query = "
        SELECT * FROM book_list_table where book_owner_user_id='$user_id' AND
        book_name LIKE '%".$search."%'
        OR book_author LIKE '%".$search."%' 
        ";
    }
    else
    {
        $query = "
        SELECT * FROM book_list_table where book_owner_user_id='".$user_id."'
        ";
    }
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) > 0)
    {
        $output .= '
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-dark">
            <tr>
                <th scope="col" class="table-header">Book Name</th>
                <th scope="col" class="table-header">Book Author</th>
                <th scope="col" class="table-header">Book Status</th>
            </tr>
        ';
        while($row = mysqli_fetch_array($result))
        {
        $output .= "
        <tr>
            <td class='thisbtn'> ".$row['book_name']." </td>
            <td class='thisbtn'> ".$row['book_author']." </td>
            <td class='thisbtn'> ".$row['book_status']." </td> 
        </tr>
        ";
        }
        echo $output;
    }
    else
    {
        echo 'Data Not Found';
    }

?>