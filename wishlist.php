<!-- PHP code to establish connection with the localserver -->
<?php
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
try{
// SQL query to select data from database
$sql = "SELECT e.Book_title , e.images, e.Book_desc ,e.BookID
 FROM e_book e, wish_list w
 WHERE e.BookID = w.BookID AND w.userid = $userid ";

$result = $mysqli->query($sql);
if (!$result) {
    throw new Exception("Error: " . $mysqli->error);
}
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="styles2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta charset="UTF-8">
	<title>Wishlist</title>
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
             <li><a href="cart.php">Cart</a></li>
		     <li><a href="checkout.php">Checkout</a></li>
		     <li><a href="accountpage.html">Account page</a></li>
        </ul>
      </nav>
    </header>
	<section>
		<h1>Books</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Book cover</th>
                <th>Book description</th>
				<th>Action</th>
			</tr>

			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
                <td><img src="<?php echo $rows['images'];?>" alt="<?php echo $rows['Book_title'];?>"></td>
                <td><?php echo $rows['Book_desc'];?></td>
				<td>
				<a href ="deletewishlist.php? userid=<?php echo $userid ?> & bookid=<?php echo $rows['BookID'] ?>"><i class="fa fa-trash-o"style="font-size:36px;color:red"></i></a>
                </td>
			</tr>
			<?php
				}
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



