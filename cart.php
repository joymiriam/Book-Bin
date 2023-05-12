<!-- PHP code to establish connection with the localserver -->
<?php
error_reporting(E_ALL ^ E_NOTICE);  
session_start();
$userid =  $_SESSION["user_id"] ;
if ($userid === "" || $userid === null) {
	echo '<script type="text/javascript">
	alert("Kindly log in");window.location.href = "loginpage.html"
	</script>';
}
$mysqli = require __DIR__ . "/connections.php";

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}
// SQL query to select data from database
$sql = "SELECT e.BookID, e.Book_title, e.Book_price, e.images, c.quantity
 FROM e_book e, cart c
 WHERE e.BookID = c.BookID AND c.userid = $userid AND c.quantity != '0' AND status = 0 ";

$result = $mysqli->query($sql);


?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="styles2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<title>Cart</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		
		table {
			margin: 0 auto;
			font-size: large;
            border:0px;
			width:100%;
			
		}

		h1 {
			text-align: center;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		th,
		td {
			font-weight: bold;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
		img {
  			width: 200px;
 			height: auto;
		}
		desc{
			width: 200px;
            height: 200px;
            text-align: justify;
		}
	</style>
</head>

<body>
    <header>
      <h1>BOOK BIN</h1>
      <nav>
        <ul>
             <li><a href="homepage.php">Home</a></li>
		     <li><a href="loginpage.html">Login page</a></li>
			 <li><a href="product.php">Products</a></li>
		     <li><a href="checkout.php">Checkout</a></li>
		     <li><a href="wishlist.php">Wishlist</a></li>
		     <li><a href="accountpage.html">Account page</a></li>
        </ul>
      </nav>
    </header>
	<section>
		<h1>Books</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
			   <th>Book ID</th>
				<th>Book cover</th>
                <th>Book Price</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th>Action</th>
			</tr>

			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{ $quantity = $rows['quantity'];
					$price = $rows['Book_price'];
					$totalprice = $rows['quantity'] * $rows['Book_price'];
					$bookid = $rows['BookID'];
					
			          ?>
			   <tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<td ><?php echo $rows['BookID'];?></td>
                <td><img src="<?php echo $rows['images'];?>" alt="<?php echo $rows['Book_title'];?>"></td>
                <td><?php echo $rows['Book_price'];?></td>
				<td ><?php echo $rows['quantity'];?></td>
				<td><?php echo $totalprice; ?></td>
				<td><a href="updatecart.php? userid=<?php echo $userid ?> & bookid=<?php echo $rows['BookID'] ?>"><i class="fa fa-plus" style="font-size:36px;color:red"></i></a> <br>
				<a href ="deletecart.php? userid=<?php echo $userid ?> & bookid=<?php echo $rows['BookID'] ?>"><i class="fa fa-minus" style="font-size:36px;color:red"></i></a>
				</td>
				</tr>

			<?php
				}
				$sql1 = "UPDATE cart SET totalprice= $totalprice WHERE userid = $userid AND BookID = $bookid ";
                $result1 = $mysqli->query($sql1);
				
				
				$mysqli->close();
				
				
			?>
		</table>
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



