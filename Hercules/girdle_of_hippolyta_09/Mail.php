<?php
	header('Content-Type: text/html; charset=utf-8');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'vendor/autoload.php';

	$email = new Email();

	class Email
	{
		public $mail;
		private $my_email;
		private $my_password;

		function __construct()
		{
			$this->setLoginDetails();
			$userInput = $this->getUserInput();

			if($userInput == 1)
			{
				$this->setSmtpDetails();
				$data =	$this->sendEmailDetails();
				$this->sendEmail($data->recipient, $data->subject, $data->message);
			}
			else if($userInput == 2)
				$this->checkReceivedEmail(5);
			else
				exit("Invalid option.");
		}

		public 	function getUserInput()
		{
			echo "1 - Send e-mail \n2 - Last 5 received e-mails\nDefault: exit \n";
			echo "Value: ";
			return (rtrim(fgets(STDIN)));
		}

		public	function setSmtpDetails()
		{
			$this->mail = new PHPMailer(true);
			$this->mail->isSMTP();
			$this->mail->SMTPSecure = 'tls';
			$this->mail->Host = "smtp.gmail.com"; 
			$this->mail->Port = 587;               
			$this->mail->SMTPAuth = true;
			$this->mail->Username = $this->my_email;
			$this->mail->Password = $this->my_password;
		}

		public function checkReceivedEmail($amount)
		{	
			set_time_limit(3000);
			$mailbox = imap_open('{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', $this->my_email, $this->my_password);
			$mail_list = imap_search($mailbox, "ALL");
			$count_emails = sizeof($mail_list) - 1;
			while($amount > 0)
			{
				$overview = imap_fetch_overview($mailbox, $mail_list[$count_emails]);
				$subject = imap_mime_header_decode($overview[0]->subject);
				echo "Subject: " . $subject[0]->text . "\n";
				$count_emails--;
				$amount--;
			}
			imap_close($mailbox);
		}

		public	function sendEmailDetails()
		{
			$data = new stdclass;
			echo "Recipient e-mail address: \n";
			$data->recipient = rtrim(fgets(STDIN));
			if(!$this->isValidEmail($data->recipient))
				exit("Invalid e-mail. Try again");		
			echo "\nSubject:\n";
			$data->subject = rtrim(fgets(STDIN));
			echo "\nMessage:\n";
			$data->message = rtrim(fgets(STDIN));
			return ($data);
		}

		private function setLoginDetails()
		{
			$this->my_email = "temp@gmail.com";
			$this->my_password = "temp";
		}

		public function sendEmail($recipient, $subject, $message)
		{
			try {
				if(!isset($recipient) || !isset($subject) || !isset($message))
				{
					throw new Exception("Check arguments (recipient, subject, message");
				}
				else
				{	
					$this->mail->SetFrom($this->my_email, 'Lucas');
					$this->mail->AddAddress($recipient);
					$this->mail->Subject = $subject;
					$this->mail->isHTML(true);
					$this->mail->Body = $message;

					if(!$this->mail->send())
						throw new Exception("Error... E-mail not sent \n" . $mail->ErrorInfo());
					else
						echo "E-mail sent with success!";
				}
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
		}

		public function isValidEmail($email)
		{
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
	}

?>
