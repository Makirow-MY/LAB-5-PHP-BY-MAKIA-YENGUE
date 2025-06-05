<?php include 'db_setup.php'; include 'auth_check.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style22.css">
</head>
<body>

<nav>
        <h1>LIBRARY SYSTEM APP</h1>
        <form method="POST">
            <input name="query" id="namesearch"  placeholder="Search here..." />
        </form>
       
    </nav>
    
<div id="dia" class="dialogue hide" >
<div class="upload">
<h2 id="titleh2">Add Book</h2>
<a href="http://localhost/crud-app/lab_5/exercise4/view_book.php" id="closebtn" class="close">X</a>

<?php if (isset($_GET['error'])):  ?> 
    <div id="error" class="error">
    <?php echo htmlspecialchars($_GET['error']);  ?> 
    </div>
<?php endif;  ?> 

<?php if (isset($_GET['success'])):  ?> 
    <div id="success" class="success">
    <?php echo htmlspecialchars($_GET['success']);  ?> 
    </div>
<?php endif;  ?> 
<form method="post" action="process_book.php">
    <div id="input"  class="input">

 <div class="sect" >
                        <label for="name">Book Title:</label>
                        <input id="title" name="title" placeholder="Enter book title" type="text" />
                    </div>
                  
                      <div class="flex flex-col" style="display: flex; flex-direction: column; align-self: flex-start;">
                            <label for="name" style="text-align: left; width: 100%;">Author Id</label>
                            <select id="author" name="author">
                            <option value="">Select available author</option>
                                <?php 
                                $host = 'localhost';
                                $dbusername = 'root' ;
                                $dbpassword = '';
                                $dbname = 'librarysystemdb';
                                
                                $con = new mysqli( $host, $dbusername, $dbpassword, $dbname);
                                
                                if (mysqli_connect_error()) {
                                    die('Connection Error ('. mysqli_connect_error() . ')'. mysqli_connect_error() );
                              } else {
                                $sql1 = "SELECT author_id, author_name FROM authors";
                                $res = $con->query($sql1);
        
                                if (!$res) {
                                    die("Invalid Query: ".$con->error);
                                }
                              
                                if ($res->num_rows > 0) {
                              
                                  while ($row = $res->fetch_assoc()) {
                                      echo "
                                       <option value='".$row['author_name']."'>".$row['author_name']."</option>
                                      ";
                                 }
                              
                                }
                                else{
                                    echo "
                                    <option value=''>No Authors Available</option>
                                   ";
                                }

                            }

                                ?>
                             
                          
                               
                            </select>
                        </div>

                    <div class="sect" >
                        <label for="name">Genre</label>
                        <input id="genre" name="genre" placeholder="Enter book genre" type="text" />
                    </div>

                    <div class="sect" >
                        <label for="name">Book Price</label>
                        <input id="price" name="price" placeholder="Enter book price" type="number" />
                    </div>

                     <div class="sect" >
                        <label for="name">Published Year</label>
                        <input id="year" name="year" placeholder="Book published year" type="number" />
                    </div>
                   
                    </div>

                <button id="uploaodButton" type="submit" name="submit" >Save</button>
    </form>                     
    
</div>
</div>

<?php if (isset($_GET['error'])):  ?> 
    <script>
    document.getElementById('titleh2').style.marginBottom = '0px'
   setTimeout(function () {
    document.getElementById('error').style.display = 'none'
      window.location.href = "http://localhost/crud-app/lab_2/exercise2/add_book.php"
   }, 3000)

 
    </script>
<?php endif;  ?> 

<?php if (isset($_GET['success'])):  ?> 
    <script>
       document.getElementById('input1').classList.add('hide')
  document.getElementById('titleh2').style.marginBottom = '0px'
 document.getElementById('input').classList.remove('hide')
    setTimeout(function () {
    document.getElementById('success').style.display = 'none';
    window.location.href = "http://localhost/crud-app/lab_2/exercise2/add_book.php"

   }, 3000)

    </script>
<?php endif;  ?> 

<script>
 function toggleForm() {
     document.getElementById('input1').classList.toggle('hide')
     document.getElementById('input').classList.toggle('hide')

     if (document.getElementById('input1').classList.contains('hide')) {
        document.getElementById('titleh2').innerText = "Add Book"
     }
     else{
        document.getElementById('titleh2').innerText = "Add Author"
     }
      
  
 }
    
</script>

</body>
</html>