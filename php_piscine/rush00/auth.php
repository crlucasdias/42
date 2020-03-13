<?php

function auth($login, $passwd){
	$hashPass = hash('whirlpool', $passwd);
	$passwdFile = unserialize(file_get_contents('./private/passwd'));
	foreach ($passwdFile as $user){
		if($login == $user['login'] && $hashPass == $user['passwd']){
			return true;
		}
	}
	echo "<div class=\"message\">nope</div>";
	return false;
}

?>