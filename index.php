<?php

$userid =  $_SESSION["user_id"];
// connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "book bin";

$conn = mysqli_connect($host, $username, $password, $dbname);

// check if the connection was successful
If (!$conn) {
    Die("Connection failed: " . mysqli_connect_error());
}


// retrieve the user’s name from the database
$sql = "SELECT username FROM users WHERE userid = $userid";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Fetch the result and store it in a variable
$row = $result->fetch_assoc();
$username = $row["username"];

// Display the username using echo
echo "Welcome, " . $username ;

// Close the database connection
$conn->close();
?>


