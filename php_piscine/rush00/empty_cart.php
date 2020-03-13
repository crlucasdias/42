
<?php

session_start();

if(isset($_SESSION['loggued_on_user'])){
	$userfile=(unserialize(file_get_contents('./private/passwd')));
	foreach($userfile as &$user){
		if($_SESSION['loggued_on_user'] == $user){
			unset($user['cart']);
		}
	}
}

unset($_SESSION['cart']);

header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/cart.php");
		die();
?>