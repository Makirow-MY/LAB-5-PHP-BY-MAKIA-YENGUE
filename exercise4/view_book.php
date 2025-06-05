
<?php include 'db_setup.php'; include 'auth_check.php';

//use Soap\Url;

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
        $sql = "DELETE FROM books  WHERE book_id='$UserId'";
                
        // Execute the query
        if (mysqli_query($con, $sql)) {
            header('Location: view_book.php');
            exit();
        } else {
            echo   header("Location: view_book.php?error=Fail+to+delete+row");
            die;
            exit();
        }
    }
    

   
        $data = [];
        $sql1 = "SELECT * FROM books";
        $res = $con->query($sql1);
        
        if (!$res) {
            die("Invalid Query: ".$con->error);
        }
      
        if ($res->num_rows > 0) {
      
          while ($row = $res->fetch_assoc()) {
              $data[] = $row;
              
         }
      
        }
      
        $con->close();
   


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style22.css">
    <style>
        nav a{
    background: rgb(0, 255, 128);
    border: none;
    padding: .5rem 1rem;
    font-size: 16px;
    color: #011426;
    text-decoration: none;
    font-weight: 550;
    cursor: pointer;
    transition: .5s ease-in-out;
    border-radius: 10px;
}
nav a:hover{
    background: rgb(3, 216, 109);
}
    </style>
</head>
<body>

<nav>
<h1>LIBRARY SYSTEM APP</h1>
        <form method="POST">
            <input name="query" id="namesearch"  placeholder="Search here..." />
        </form>
        <a href="http://localhost/crud-app/lab_5/exercise4/add_book.php" type="button" id="btn" class="uploadbtn">
        + Add</a>
         <a href="logout.php" type="button" id="btn" class="uploadbtn1 btn-danger">
        logout</a>
    </nav>

    
    
    <div class="maincntainer">

<div class="container">

    <table className="table" id="usertable">
        
        <thead>
        <tr>
            <th>#</th>
            <th>book title</th>
            <th>book Author</th>
            <th>genre</th>  
            <th>price</th>
             <th>published Year</th>                
           
                          
        </tr>
        </thead>
       
        <tbody className="hover">

        <?php if (empty($data)):  ?> 

      <tr   id="tableCont"  >
            <td style="opacity: 0;"></td>
            <td style="opacity: 0;"></td>
            <td style="border: none; font-size: 20px;">No Book Found Yet!</td>
            <td style="opacity: 0;"></td>
            <td style="opacity: 0;"></td>
          
           
            </td>
            
            
        </tr>
 
<?php endif;  ?>


<?php if (!empty($data)):  ?> 

            <?php foreach($data as $data):                  
        ?>

<tr onclick="SelectRow(this)" data-id="<?= $data['book_id'] ?>" key='<?= $data['book_id'] ?>' id="tableCont"  >
            <td><?= $data['book_id'] ?></td>
            <td><?= $data['title'] ?></td>
            <td><?= $data['author'] ?></td>
            <td><?= $data['genre'] ?></td>
            <td><?= $data['price']."frs" ?></td>
             <td><?= $data['publication_year'] ?></td>
            
            
        </tr>

<?php endforeach; ?>   
<?php endif;  ?>
       
        </tbody>
    </table>

</div>

</div>


<div id="dia" class="dialogue" >
<div class="upload">
<h2 id="titleh2">Add Student</h2>
  <div id="closebtn" class="close">X</div>

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
<form method="post" action="edit_book.php">
    <div id="input"  class="input">

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
                        <label for="name">Book Title:</label>
                        <input id="title" name="title" placeholder="Enter book title" type="text" />
                    </div>
                      
                    <div class="sect" >
                        <label for="name">Genre</label>
                        <input id="genre" name="genre" placeholder="Enter book genre" type="text" />
                    </div>

                    <div class="sect" >
                        <label for="name">Book Price</label>
                        <input id="price" name="price" placeholder="Enter book price" type="text" />
                    </div>
                     <div class="sect" >
                        <label for="name">Published Year</label>
                        <input id="year" name="year" placeholder="Book published year" type="number" />
                    </div>
                     <div class="sect" style="display: none;" >
                        <input id="UserId" name="UserId" type="text" />
                    </div>

                  
                    </div>

                  
                <button id="uploaodButton" type="submit" name="submit" >Create Book</button>
    </form>                     
    
</div>
</div>


<script>
function SelectRow(row) {

// Deselect all previously selected rows
const isSelected = row.classList.toggle('selected');
const userCell = row.cells[0];


const allRows = document.querySelectorAll('tr'); // Adjust the selector to target your specific table rows
allRows.forEach(r => {
   if (r.classList.contains('selected') && r !== row) {
       r.classList.remove('selected');
       const userCell = r.cells[0];
       userCell.innerHTML = r.dataset.id; // Restore user ID or previous content
   }
});


// 
 if(isSelected)
 {
    const doc =  document.getElementById('dia').classList.add('hide')
        const button = document.createElement('a')
       button.innerText = "Delete"
          button.type = 'submit';
          button.href = `/crud-app/lab_5/exercise4/delete_book.php?id=${row.dataset.id}`
          button.style = 'padding: 3px; color: white;  text-decoration: none; background: red; '
           userCell.innerHTML = '';
          userCell.appendChild(button)

document.getElementById('title').value = row.cells[1].innerHTML
document.getElementById('author').value = row.cells[2].innerHTML
   document.getElementById('price').value = row.cells[4].innerHTML
   document.getElementById('genre').value = row.cells[3].innerHTML
   document.getElementById('year').value = row.cells[5].innerHTML
   document.getElementById('UserId').value =   row.dataset.id
     document.getElementById('uploaodButton').innerText = "Save Changes"
   document.getElementById('titleh2').innerText = "Edit Information"
   
 }
 else{
   const userId = row.dataset.id
          userCell.innerHTML = '';
          userCell.innerHTML = userId
 }
}


 const closebtn = document.getElementById('closebtn')
closebtn.addEventListener('click', function() {
    document.getElementById('dia').classList.remove('hide')
    document.getElementById('name').value = null
    document.getElementById('email').value = null;
    document.getElementById('number').value = null
      
      
     document.getElementById('uploaodButton').innerText = "Create Student"
        document.getElementById('titleh2').innerText = "Add Student"
}) 


  </script>

</body>
</html>