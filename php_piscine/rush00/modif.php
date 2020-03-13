<!-- ========== always stuff ========= -->

<?php
/* ========== header ========= */

include ("header.php");

?>

<?php
/* ========== modif backend ========= */

	if($_POST['submit'] == 'OK' && $_POST['login'] && $_POST['oldpw'] && $_POST['newpw']){
		$passwdFile = unserialize(file_get_contents('./private/passwd'));
		$oldHashpass = hash('whirlpool', $_POST['oldpw']);
		$newHashpass = hash('whirlpool', $_POST['newpw']);
		foreach ($passwdFile as &$user){ // can also do: foreach ($passwdFile as $user=>$duckies){
			if($_POST['login'] == $user['login']){
				if($oldHashpass == $user['passwd']){
					$user['passwd'] = $newHashpass;
					file_put_contents('./private/passwd', serialize($passwdFile));
					header("Location: http://localhost:". $_SERVER['SERVER_PORT'] . "/index.php");
					die();
					return;
				}
			}
		}
		echo "ERROR\n";
	}
	else{
		echo "ERROR\n";
		return;
	}
?>