<?php

session_start();

?>
<html>
<head>
	<title>eCommerce Storefront</title>
	<link href="styles.css" rel="stylesheet" type="text/css">
	<script src="scripts.js" type="text/javascript"> </script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body>
<p class="title"><a href="index.php">store.com</a>

<?php
if(isset($_SESSION['loggued_on_user'])) {
	if($_SESSION['loggued_on_user'] == "Crystal" || $_SESSION['loggued_on_user'] == "Lucas") {?>
	<a href="admin-u.php"><?php echo "<< ADMIN MODE >>" ?></a>

</p>

<?php
	}
}

echo "<div class = \"topbar\" id = \"topbar\">";

if(isset($_SESSION['loggued_on_user'])){
	echo "<div class=\"navlink\"><a href=\"modif.html\">";
	echo $_SESSION['loggued_on_user'];
	echo "</a></div>";
	echo "<div class=\"navlink\"><a href=\"logout.php\">Logout</a></div>";
}
else{
	echo "<div class=\"navlink\"><a href=\"login.php\">Login</a></div>";
	echo "<div class=\"navlink\"><a href=\"create.php\">Sign Up</a></div>";
}
?>
	<div class="navlink">
		<a href="cart.php">Cart <span class="qtd-cart"> 0 </span> </a>
	</div>
	<div class="wrapper">
		<div class="dropdown">
			<button class="dropbtn">SHOP</button>
				<div class="dropdown-content">
					<a href="cat.php?category=1">pointy</a>
					<a href="cat.php?category=2">yellow</a>
					<a href="cat.php?category=3">edible</a>
				</div>
			</div>
		</div>
	</div>
</div>