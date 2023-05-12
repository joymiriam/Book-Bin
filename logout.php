<?php
 $mysqli = require __DIR__ . "/connections.php";
session_start();

if(session_destroy())

{

header("Location: loginpage.html");

}

?>