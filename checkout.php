
<!-- PHP code to establish connection with the localserver -->
<?php


session_start();
$date = date("Y-m-d H:i:s");
$userid =  $_SESSION["user_id"] ;
if ($userid === "" || $userid === null) {
	echo '<script type="text/javascript">
	alert("Kindly log in");window.location.href = "loginpage.html"
	</script>';
}
define('DELIVERY_FEE', 100);
$valuesum = 0;
$mysqli = require __DIR__ . "/connections.php";

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = "SELECT e.BookID, e.Book_title, c.totalprice 
FROM e_book e, cart c
WHERE e.BookID = c.BookID AND c.userid = $userid AND c.quantity != '0' AND status = 0 ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="styles2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<title>Checkout</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  background-color: grey;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #FFB3B3;
}

.sh {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
hr.rounded {
  border-top: 6px solid #bbb;
  border-radius: 5px;
}
</style>
</head>

<body>
    <header>
      <h1>BOOK BIN</h1>
      <nav>
        <ul>
             <li><a href="homepage.php">Home</a></li>
             <li><a href="accountpage.html">Account page</a></li>
		         <li><a href="loginpage.html">Login page</a></li>
             <li><a href="product.php">Products</a></li>
             <li><a href="cart.php">Cart</a></li>
		         <li><a href="wishlist.php">Wishlist</a></li>
		    
        </ul>
      </nav>
    </header>
	<section>
		<h2>Book checkout</h2>
    <?php
// LOOP TILL END OF DATA
while($rows=$result->fetch_assoc())
{  
  $valuesum +=$rows['totalprice'];
?>
<div class="sh">
  <form  method="post" action="testdetails.php" >
    <label for="btitle">Book title</label>
    <input type="text" id="btitle" value="<?php echo $rows['Book_title']; ?>">

    <label for="bprice">Book price</label>
    <input type="text" id="bprice" value="<?php echo $rows['totalprice']; ?>"disabled>
        
    
    <hr class="rounded">
    <?php
     }
   ?>
    
    <label for="adress">Shiping Address</label>
    <input type="text" id="adress" name="adress" placeholder="Your Address..." required >
    
    <label for="cno">Card Number</label>
    <input type="text" id="cno" name="cardnumber" placeholder="Your Card Number.." required>
    
    <label for="dfee">Delivery fee</label>
    <input type="text" id="dfee" value="<?php echo "Ksh" . DELIVERY_FEE  ;?>" disabled>

    <label for="price">Value sum</label>
    <input type="text" name= "totalprice" id="price"value="<?php echo ($valuesum + DELIVERY_FEE) ;?>" >

    <input type="submit" name = "submit" value="submit">
  </form>
</div>
	</section>
<footer>
    <div class="contact-us">
    <h3>Contact Us</h3>
    <p><b>456-01001, Kenyatta Avenue, Nairobi, KENYA</b></p>
    <p><b>Phone: (+254) 7-2456-7890 or (+254) 7-2456-7890</b></p>
    <p><b>Email: bookbin@gmail.com</b></p>
	  <p><b>&copy; 2023 Book Bin</b></p>
    </div>
</footer>
</body>
</html>






