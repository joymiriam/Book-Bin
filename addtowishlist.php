<?php
$user = $_GET['userid'];
$bookid = $_GET['bookid'];
$date = date("Y-m-d H:i:s");


$mysqli = require __DIR__ . "/connections.php";
$sql3 = ("SELECT * FROM wish_list
                    WHERE BookID = '$bookid' AND userid ='$user'");
                   
    
    $result = $mysqli->query($sql3);
    
    $book = $result->fetch_assoc();
    if ($book) 
        {
          echo '<script type="text/javascript">
          alert("Book already exist in wishlist");window.location.href = "wishlist.php"
          </script>';
        
        }
        else{

$sql = "INSERT INTO `wish_list`(`BookID`, `userid`, `create_date`, `update_date`,`quantity`) 
        VALUES ('$bookid','$user','$date','$date',1)";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql))
{
  die("SQL error: " . $mysqli->error);
}

if($stmt->execute())
{
 header("location:wishlist.php");
 exit;
}else
{
    die($mysqli->error . " " . $mysqli->errno) ;
}
        }

?>