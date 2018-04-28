<?php
	session_start();
    
    if(!isset($_SESSION["user_id"]))
    {
        header('Location: index.php');
    }

    $user_id = $_SESSION["user_id"];

    // Count Lent Book number
    include "magic/db.php";
    $result = mysqli_query($link, "SELECT COUNT(`book_id`) FROM book_list_table where book_owner_user_id='$user_id' AND book_status='Lent'");
    $row = mysqli_fetch_assoc($result);
    $lent_book = $row['COUNT(`book_id`)'];
?>

<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="css/home.css">

		<title>My Personal Online Book Tracker</title>
	</head>
	<body>
		<div id="full-page">
            <h1 id="heading">Lent History</h1>

            <div class="container-fluid">
                <div class="row" >          
                    <div id="sidebar" class="col-3">
                        <ul class="nav navbar-nav navbar-right" id="menu-list">
                            <div id="username">
                                <?php echo "User : " . $_SESSION["user_name"] ?>
                            </div>
                            <a href="home.php"><li>All Book List</li></a>
                            <a href="lent_book_list.php"><li>Lent Book List <span class="badge badge-light"><?php echo $lent_book; ?></span> </li></a>
                            <a href="lent_history.php" class="activelink"><li>Lent History</li></a>
                            <a href="add_new_books.php"><li>Add New Book</li></a>
                            <a href="lend_book.php"><li>Lend Someone a Book</li></a>

                            <form class="form-inline" action="magic/logout.php">
                                <button id="logout-btn" class="btn btn-outline-success" type="submit">Logout</button>
                            </form>
                        </ul>       
                    </div>

                    <div id="content" class="col-9">
                        <div id="all-book-list">
                            <table class="table table-bordered table-hover table-dark">
                                <thead>
                                <tr>
                                    <th scope="col" class="table-header">Book Name</th>
                                    <th scope="col" class="table-header">Lent To</th>
                                    <th scope="col" class="table-header">Return Date</th>
                                    <th scope="col" class="table-header">Expected Return Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include "magic/db.php";
                                        $sql = "SELECT * FROM lent_book_list INNER JOIN book_list_table ON book_list_table.book_id=lent_book_list.book_id where lent_book_list.book_owner_id=$user_id ";

                                        $result = mysqli_query($link, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result) ) {
                                                echo "
                                                    <tr>
                                                        <td class='thisbtn'> ".$row['book_name']." </td>
                                                        <td class='thisbtn'> ".$row['lent_to_name']." </td>
                                                        <td class='thisbtn'> ".$row['returned_date']." </td>
                                                        <td class='thisbtn'> ".$row['expected_date_of_return']." </td>                                                        
                                                    </tr> 
                                                    ";                                                                                                                                                                                                                 
                                            }
                                        } else {
                                            echo "<tr>
                                                    <td> 0 Books </td>
                                                  </tr> 
                                                ";
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
		</div>
		
		

		<!-- Optional JavaScript -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>