<?php
$user = $_GET['userid'];
$bookid = $_GET['bookid'];
$date = date("Y-m-d H:i:s");

$mysqli = require __DIR__ . "/connections.php";
$sql1 = ("SELECT * FROM wish_list
                    WHERE BookID = '$bookid' AND userid ='$user' ");
                    
    $result = $mysqli->query($sql1);
    
    $book = $result->fetch_assoc();
    if (!$book) 
        {
          echo '<script type="text/javascript">
          alert("Something went wrong");window.location.href = "wishlist.php"
          </script>';
        
        }
        if ($initialqty == 0) {
            $sql2 = "DELETE FROM wish_list WHERE BookID = '$bookid' AND userid ='$user'";
        
            if($mysqli->query($sql2)){
                echo '<script type="text/javascript">
                alert("Book successfully deleted");window.location.href = "wishlist.php"
                </script>';
            } else {
                echo '<script type="text/javascript">
                alert("Something went wrong");window.location.href = "wishlist.php"
                </script>';
            }
        } else {
            $updatedqty = $initialqty -1;
        
            $sql = "UPDATE wish_list SET quantity = '$updatedqty' WHERE BookID = '$bookid' AND userid ='$user'";
        
            $stmt = $mysqli->stmt_init();
        
            if (!$stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }
        
            if ($stmt->execute()) {
                header("location:wishlist.php");
                exit;
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
        