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
  
    
    $author_name = filter_input(INPUT_POST, 'authorName'); 
    $bio = filter_input(INPUT_POST, 'authorBio');

    $author = filter_input(INPUT_POST, 'author'); 
    $title = filter_input(INPUT_POST, 'title');
    $genre = filter_input(INPUT_POST, 'genre');
    $price = filter_input(INPUT_POST, 'price');
      $year = filter_input(INPUT_POST, 'year');
    $RnadomlyGenerateId1 =  rand(10000000, 2147483000);

    echo 'title'.$title.'author'.$author.'genre'.$genre;

    if (!empty($title) && !empty($author) && !empty($genre) && !empty($price) && is_numeric($price)){
          
            $sql = "INSERT INTO books (title, genre, price, author, publication_year) VALUES ('$title', '$genre','$price', '$author', '$year')";
         
          
          
             if (mysqli_query($con, $sql)) {
                     header('Location: /crud-app/lab_5/exercise4/view_book.php');
                    exit;
                } else {
                    header("Location: /crud-app/lab_5/exercise4/add_book.php?error=Sorry,+failed+to+update+information");
                    die;
                    exit();
                }
         
            die;
           
        }
        else {
            header("Location: /crud-app/lab_5/exercise4/add_book.php?error='title'.$title.'author'.$author.'genre'.$genre;");
         }


    

 }

     
        $con->close();
 }



?>