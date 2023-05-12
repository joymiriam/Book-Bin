<?php
$mysqli = require __DIR__ . "/connections.php";

// Start the session
session_start();
$userid =  $_SESSION["user_id"]; 
$date = date("Y-m-d H:i:s");

// Validate the form data
if (isset($_POST['submit'])) {
  $price = isset($_POST['totalprice']) ? $_POST['totalprice'] : null;
  $address = isset($_POST['adress']) ? $_POST['adress'] : null;
  $cardnumber = isset($_POST['cardnumber']) ? $_POST['cardnumber'] : null;


  // Save the order information to the database
  $sql = "INSERT INTO orders (user_id, price, adress, create_date, update_date, card_number) 
          VALUES (?, ?, ?, ?, ?, ?)";

  $stmt = $mysqli->prepare($sql);

  if (!$stmt) {
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    exit;
  }

  $stmt->bind_param("idssss", $userid, $price, $address, $date, $date, $cardnumber);

  if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    exit;
  }

  $orderid = $mysqli->insert_id; 

  $sql = "SELECT *
          FROM cart 
          WHERE userid = $userid AND 'status' = 0";
$result = $mysqli->query($sql);

while($rows=$result->fetch_assoc()){
  $cartid = $rows['Cart_id'];
  
  $sql1 = "UPDATE cart SET status = 1 , OrderID = $orderid WHERE Cart_id = $cartid ";
                $result1 = $mysqli->query($sql1);
}

  echo '<script type="text/javascript">
                alert("Thank you for your order! We have received your details and will process your order shortly ");window.location.href = "homepage.php"
                </script>';
  
  exit;
}
?>
