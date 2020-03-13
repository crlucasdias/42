<?php

class Email {

	public function newComment($to)
	{
		$subject = "New comment - Camagru";
		$header  = "From: lucasdias.blend@gmail.com" . "\n";
		$msg = "You receive a new comment on your post. Take a look ;)\n";
		return(mail($to, $subject, $msg, $header));
	}

	public function forgotPassword($to, $token)
	{
		$subject = "Forgot your password - Camagru";
		$header  = "From: lucasdias.blend@gmail.com" . "\n";
		$url = "http://localhost:" . $_SERVER['SERVER_PORT'] . "/recover_password.php?token=$token";
		$msg = "To recover your account , click here: $url \n";
		return(mail($to, $subject, $msg, $header));
	}

	public function validateAccount($name, $to, $token)
	{
		$subject = "Validate your account - Camagru";
		$header  = "From: lucasdias.blend@gmail.com" . "\n";
		$url = "http://localhost:" . $_SERVER['SERVER_PORT'] . "/validate_token.php?token=$token";
		$msg = "Hello $name, \n To validate your account on Camagru Project, click here: $url \n";
		return(mail($to, $subject, $msg, $header));
	}
	
}