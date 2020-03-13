<?php
// Just started this June 15 2019; does not work

session_start();

if (isset($_POST['submit'] == "add"))
{
	$_SESSION['cart'] = $_POST['item'];
}
?>