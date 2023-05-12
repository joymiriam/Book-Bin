<?php
$user = $_GET['userid'];
$bookid = $_GET['bookid'];
$date = date("Y-m-d H:i:s");


$mysqli = require __DIR__ . "/connections.php";
$sql1 = ("SELECT * FROM cart
                    WHERE BookID = '$bookid' AND userid ='$user' AND status = 0 ");
                   
    
    $result = $mysqli->query($sql1);
    
    $book = $result->fetch_assoc();
    if ($book) 
        {
          echo '<script type="text/javascript">
          alert("Book already exist in cart");window.location.href = "product.php"
          </script>';
        
        }
        else{

$sql = "INSERT INTO `cart`(`BookID`, `quantity`, `userid`, `create_date`, `update_date`) 
        VALUES ('$bookid','1','$user','$date','$date')";

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