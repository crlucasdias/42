
<?php

/* ========== header ========= */


include ("header.php");
include 'auth.php';

if(isset($_POST['submit']) && isset($_POST['login']) && isset($_POST['passwd']))
{
	
	if ($_POST['submit'] == "OK" && auth($_POST['login'], $_POST['passwd'])){
		$_SESSION['loggued_on_user'] = $_POST['login'];
		if($_POST['login'] == "Lucas" || $_POST['login'] == "Crystal"){
			$_SESSION['admin'] = 'admin';
		}

		header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
		die();
	}
}
else{
	unset($_SESSION['loggued_on_user']);
	echo "wrong username or password\n";
	echo "<p><a href=\"login.html\">retry</a>";
}
?>
</div>
</body></html>