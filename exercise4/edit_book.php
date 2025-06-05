<?php  

//use Soap\Url;
$host = 'localhost';
$dbusername = 'root' ;
$dbpassword = '';
$dbname = 'LibraryDB';

$con = new mysqli( $host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()) {
    die('Connection Error ('. mysqli_connect_error() . ')'. mysqli_connect_error() );
} else {
   

 if ($_SERVER['REQUEST_METHOD'] == "POST") {
  
   
  
    $author = filter_input(INPUT_POST, 'author'); 
    $title = filter_input(INPUT_POST, 'title');
    $genre = filter_input(INPUT_POST, 'genre');
    $price = filter_input(INPUT_POST, 'price');
      $year = filter_input(INPUT_POST, 'year');
        $UserId = filter_input(INPUT_POST, 'UserId');
 
        if (!empty($UserId)) {
            
            
         $sql = "UPDATE Books  SET title='$title', genre='$genre', author='$author', publication_year='$year', price='$price' WHERE book_id='$UserId'";  
             if (mysqli_query($con, $sql)) {
                    header('Location: /crud-app/lab_5/exercise4/view_book.php');
                    exit;
                } else {
                    header("Location: /crud-app/lab_5/exercise4/view_book.php?error=Sorry,+failed+to+update+information");
                    die;
                    exit();
                }

        }
      else{
         header("Location: /crud-app/lab_5/exercise4/view_book.php?error=Failed+to+get+id");
                    die;
                    exit();
      }
 }

     
        $con->close();
 }



?>