<?php
session_start();
$user = $_POST['username'];
$passwrd = $_POST['password'];

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/connections.php";
    
    $sql = ("SELECT * FROM users
                    WHERE username = '$user' AND passwrd ='$passwrd'");
                   
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) 
        {
        
             $_SESSION["user_id"] = $user["userid"];
            
            header("Location: product.php");
        
        }
        else{
            echo '<script type="text/javascript">
            alert("invalid credentials");window.location.href = "loginpage.html"
            </script>';
            
        }
    }
    
    $is_invalid = true;


?>