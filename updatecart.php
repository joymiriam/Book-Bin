<?php
$user = $_GET['userid'];
$bookid = $_GET['bookid'];
$date = date("Y-m-d H:i:s");


$mysqli = require __DIR__ . "/connections.php";
$sql1 = ("SELECT * FROM cart
                    WHERE BookID = '$bookid' AND userid ='$user'");
                   
    
    $result = $mysqli->query($sql1);
    
    $book = $result->fetch_assoc();
    if (!$book) 
        {
          echo '<script type="text/javascript">
          alert("Book does not exist in cart");window.location.href = "cart.php"
          </script>';
        
        }
        else{
$initialqty = $book["quantity"] ;
$updatedqty = $initialqty +1;          
$sql = " UPDATE cart
         SET quantity = '$updatedqty'
         WHERE BookID = '$bookid' AND userid ='$user'";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql))
{
  die("SQL error: " . $mysqli->error);
}

if($stmt->execute())
{
 header("location:cart.php");
 exit;
}else
{
    die($mysqli->error . " " . $mysqli->errno) ;
}
        }

?>