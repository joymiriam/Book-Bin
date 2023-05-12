<?php
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$user = $_POST['username'];
$email = $_POST['email'];
$passwrd = $_POST['password'];
if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
{
  die("Valid email is required");
}
if (strlen($_POST["password"]) < 5)
{
  die("Password must be at least 5 characters");
}
if ($_POST["password"] !== $_POST["password_confirmation"] ) 
{
  die("Passwords must match");
}
echo($user);
$mysqli = require __DIR__ . "/connections.php";

$sql = "INSERT INTO users (username, passwrd, email, f_name, l_name)
        VALUES('$user','$passwrd', '$email', '$f_name', '$l_name')";

$stmt = $mysqli->stmt_init();

if(!$stmt->prepare($sql))
{
  die("SQL error: " . $mysqli->error);
}

if($stmt->execute())
{
 header("location:signup-success.html");
 exit;
}else
{
  if ($mysqli->errno === 1062)
{
  die("Email already taken");
}
  else
  {
    die($mysqli->error . " " . $mysqli->errno) ;
  }
}
 

