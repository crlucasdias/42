
<?php

/* ========== useredit ========= */

	echo "welcome to useredit <br>";
	$passwdFile = unserialize(file_get_contents('./private/passwd'));
	print_r($_POST);
	foreach ($passwdFile as $key => &$user){

		
		if($_POST["username"] == $user['login']){
			if(isset($_POST['editUser']))
			{
				$passwdFile[$_POST['newUsername']] = $passwdFile[$key];
				$passwdFile[$_POST['newUsername']]['login'] = $_POST['newUsername'];
			}
			unset($passwdFile[$key]);
			unset($user);
			print_r($passwdFile);
			file_put_contents('./private/passwd', serialize($passwdFile));
			
			echo "<a href=\"admin-u.php\">back</a>";
			header("Location: http://localhost:". $_SERVER['SERVER_PORT'] .  "/admin-u.php");
			die();
		}
	}
	?>
