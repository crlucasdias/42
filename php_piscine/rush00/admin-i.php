<!-- ========== navigation/header ========== -->

<html>
<head>
	<title>Admin stuff</title>
	<link href="styles.css" rel="stylesheet" type="text/css">
	<script src="scripts.js" type="text/javascript"> </script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
</head>
<p class="title"><a href="index.php">store.com</a></p>
<body>
Admin stuff : <a href="admin-u.php">Users</a> | <span class="menu-selected">Items</span>
</body>

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

<!-- ========== items display & forms ========== -->

<div class="shop">
<?php
include ("functions.php");

$items = unserialize(file_get_contents('./private/items'));
$itemcount = 0;
foreach($items as $item)
{

getItemAdmin($item);
$itemcount++;

if($itemcount == 4)
{?>
<p><a href="newItem.php"> Add Item </a></p>
<p><a href="item_creator.php"> Reset Items </a></p>
</div>
<?php
}}
?>

<script>

	let GLOBAL_CATEGORIES = {};

	let tmp = document.querySelectorAll(".iteminfo");
	//for(var i = 0; i < tmp.length; i++)
	//{
	//	var name = 
	//}
</script>
</html>