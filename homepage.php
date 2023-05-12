<?php
session_start();
$userid =  $_SESSION["user_id"] ;
if ($userid === "" || $userid === null) {
	echo '<script type="text/javascript">
	alert("Kindly log in");window.location.href = "loginpage.html"
	</script>';
}
$mysqli = require __DIR__ . "/connections.php";
?>
<html>
  <head>
    <title>BOOK BIN</title>
    <link rel="stylesheet" type="text/css" href="styles2.css">
    <style>
      .logout{
     position:absolute;
     top: 120px;
      left: 5px;
      background-color: #383f51; 
      border: none;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 16px;
      margin: 4px 2px;
      border-radius: 12px;
   
  }
    </style>
    
  </head>
  
  <body >
    <header>
      <h1>BOOK BIN</h1>

      <nav>
        <ul>
          <li><a href="homepage.php">Home</a></li>
		      <li><a href="loginpage.html">Login page</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="product.php">Products</a></li>
		  <li><a href="checkout.php">Checkout</a></li>
		  <li><a href="wishlist.php">Wishlist</a></li>
		  <li><a href="accountpage.html">Account page</a></li>
		  
        </ul>
      </nav>
    </header>
        <button><a href="accountpage.html" class="signbutton">Sign up</a></button>
        <button1><a href="loginpage.html" class = "loginbutton">Log in</a></button1>
        <button2> <a href="logout.php" class = " logout" title="Logout">Logout </a></button2>
        
    <main>
      <section>
        <h2><b><p style="color: #ff9999; font-size: 30px;"><?php include("index.php")?> to Book Bin!</p></b></h2>
        
      </section>
          
      <b><h2>About us</h2>
      Book bin was created in order to give customers a simple method to browse, buy, and receive books from the comfort of their homes.<br> A wide variety of customers, from casual readers to ardent book fans can be served by book bin by providing a large selection of books in different genres and formats.<br>
      In general, the goal of book bin is to increase customer convenience and accessibility when purchasing books while simultaneously giving authors and publishers a platform to reach a larger audience.
      <p>At Book Bin, we are dedicated to providing high-quality books for all ages and interests. Browse our selection today!</p>
      <section>
        <h2>Featured Books</h2>
        <ul>
          <li>
            <img src="images\tc.jpeg" alt="Book 1" width="100" height="140">
            <h3>Terms and Conditions</h3>
			<p style="color:  #ff9999; font-size: 20px;">Book by Lauren Asher</p>
            <p><b>
			This book follows Declan who has to complete his grandfather's inheritance clause by getting married and having a family. <br>Declan needs to find someone to marry him and Iris, Declan's assistant,<br> steps up and agrees to marry him so he can get his inheritance.</b></p>
          </li>
          <li>
            <img src="images\ug.jpeg" alt="Book 2" width="100" height="140">
            <h3>Ugly Love</h3>
			<p style="color:  #ff9999; font-size: 20px;">Book by Colleen Hoover</p>
            <p>One of Colleen Hoover's most notable books is Ugly Love. The protagonist of this tale is Tate, a lady who develops feelings for Miles, a withdrawn and depressed man. <br>These two souls instantly connect when they come into contact.<br> Miles, however, is a broken man who can only provide Tate with a sexual relationship.</p>
          
          </li>
          <li>
            <img src="images\jh.jpeg" alt="Book 3" width="100" height="140">
            <h3>Juniper Hill</h3>
			<p style="color:  #ff9999; font-size: 20px;">Book by Devney Perry</p>
            <p><b>She temporarily rents from Knox Eden, a chef who is a lovely and wicked dream.<br> He is rough and gruff, everything she has never had and<br> never will have, with a sharp, stubbled jaw and tattooed arms.<br> Memphis discovered that living a decent life means giving up<br> on dreams as well after experiencing the worst day of her life.</b></p>
            
          </li>
        </ul>
      </b>
      </section>
     </main>
      
	</body>
<footer>
  <div class="contact-us">
  <h3><a href="contactpage.html">Contact Us</a></h3>
    <p><b>456-01001, Kenyatta Avenue, Nairobi, KENYA</b></p>
    <p><b>Phone: (+254) 7-2456-7890 or (+254) 7-2456-7890</b></p>
    <p><b>Email: bookbin@gmail.com</b></p>
	<p><b>&copy; 2023 Book Bin</b></p>
  </div>
 

    </footer>
  </body>
</html>
