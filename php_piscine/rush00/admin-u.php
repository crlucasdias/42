<!-- ========== navigation/header ========== -->

<html>
<head>
	<title>Admin stuff</title>
	<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<p class="title"><a href="index.php">store.com</a></p>
<body>
Admin stuff : <span class="menu-selected">Users</span> | <a href="admin-i.php">Items</a>
	

<?php

session_start();

/* ========== security check for non-admin users ========== */

if(isset($_SESSION['loggued_on_user']))
{
	if($_SESSION['loggued_on_user'] != "Crystal" && $_SESSION['loggued_on_user'] != "Lucas")
	{
		header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
		die();
	}
}
else
{
	header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
	die();
}
?>
<!-- ========== users display & forms ========== -->
<?php
$users = unserialize(file_get_contents('./private/passwd'));
foreach($users as $user){
	?>
<div class="user">
	<?php
	echo $user['login'];
	
	if($user['login'] == "Lucas" || $user['login'] == "Crystal"){
			echo " (admin)";
		}
		?>
<form method="post" action="useredit.php" name="useredit.php">
	<p>
	<?php
	if($user['login'] != "Lucas" && $user['login'] != "Crystal")
	{ ?>
		<p class="little">change name to: <input type="text" name="newUsername" value="<?php echo $user['login']; ?>"></p>
		<input type="submit" value="rename <?php echo $user['login']; ?>" name="editUser">
		<input type="submit" value="delete <?php echo $user['login']; ?>" name="delete">
	<?php } ?>
	<input type="hidden" value="<?php echo $user['login']; ?>" name="username">
</form></p>
</div>
<?php
}

?>
</body>
</html>