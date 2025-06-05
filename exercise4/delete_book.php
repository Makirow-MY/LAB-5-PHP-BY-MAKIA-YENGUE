<?php

$host = 'localhost';
$dbusername = 'root' ;
$dbpassword = '';
$dbname = 'LibraryDB';

$con = new mysqli( $host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
      die('Connection Error ('. mysqli_connect_error() . ')'. mysqli_connect_error() );
} else {
   

    if (isset($_GET["id"])) {
        $UserId = $_GET["id"];
        $sql = "DELETE FROM Books  WHERE book_id='$UserId'";
                
        // Execute the query
        if (mysqli_query($con, $sql)) {
            header('Location: /crud-app/lab_5/exercise4/view_book.php');
            exit();
        } else {
            echo   header("Location: /crud-app/lab_5/exercise4/view_book.php?error=Fail+to+delete+row");
            die;
            exit();
        }
    }
}

?>