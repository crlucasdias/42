<?php
	include_once("session.php");
	include_once("config/database.php");
	include_once("Email.php");

	class Register {

		private $pdo;
		private $name;
		private $email;
		private $password;
		
		public function __construct($db)
		{
			$this->pdo = $db->conn;
		}

		private function verify($name, $email, $password1, $password2)
		{
			if(strlen($email) < 3)
				return(0);
			if(strlen($name) < 3)
				return(0);
			if(strlen($password1) < 3)
				return(0);
			if(strlen($password2) < 3)
				return(0);
			if($password1 != $password2)
				return(0);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  				return(0);
			}
			return(1);
		}

		public function checkUser($name, $email, $password1, $password2)
		{
			if(!$this->verify($name, $email, $password1, $password2))
				echo json_encode(array("error" => "Something went wrong"));
			else
			{
				$this->name = $name;
				$this->email = $email;
				$this->password = md5($password1);
				if($this->newUser($this->email, $name))
					$this->insertIntoDb();
				else
					echo json_encode(array("error" => "User already on db"));
			}
		}

		private function newUser($email, $username)
		{
			$sql = "SELECT email, name FROM user WHERE email = :email OR name = :name";
			try 
			{
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':name', $username);
				$stmt->execute();
				$result = $stmt->rowCount();
				if(!$result)
					return(true);
				else
					return(false);
			} catch(Exception $e) {
			    echo 'Exception -> ';
			    echo json_encode(array("error" => $e->getMessage()));
			}
		}

		private function insertIntoDb()
		{
			$token = $this->generateToken();
			$date = date('Y-m-d H:i:s');
			$limit = strtotime("$date + 15 minute");
			$status = "pending";

			$sql = "INSERT INTO user (name, email, password, token, token_validate, account_status) 
			VALUES (:name, :email, :password, :token, :token_validate, :account_status)";

			try {
				$stmt = $this->pdo->prepare($sql);
				$stmt->bindParam(':name', $this->name);
				$stmt->bindParam(':email', $this->email);
				$stmt->bindParam(':password', $this->password);
				$stmt->bindParam(':token', $token);
				$stmt->bindParam(':token_validate', $limit);
				$stmt->bindParam(':account_status', $status);
				if (!$stmt->execute()) {
   					 echo json_encode(array("error" => "Something went wrong"));
				}
				else
				{
					$email = new Email();
					if($email->validateAccount($this->name, $this->email, $token))
						echo json_encode(array("ok" => true));
					else
						echo json_encode(array("error" => "Something went wrong"));
				}
			} catch (Exception $e) {
				echo 'Exception -> ';
			    var_dump($e->getMessage());
			}
		}

		private function generateToken()
		{
			return ($token = bin2hex(random_bytes(64)));
		}

	}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	if(isset($name) && isset($email) && isset($password1) && isset($password2))
	{
		$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
		$register = new Register($conn);
		$register->checkUser($name, $email, $password1, $password2);
		//$token = $this->generateToken();
		//$date = date('Y-m-d H:i:s');
		//$limit = strtotime("$date + 15 minute");
	}
?>