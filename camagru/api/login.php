<?php
include_once("config/database.php");
include_once("Email.php");

class Login {
	private $pdo;

	public function __construct($conn)
	{
		$this->pdo = $conn;
	}

	public function isUserValid($current, $password)
	{
		$sql = "SELECT * FROM user WHERE email = :email OR name = :name AND password = :password";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->bindParam(':email', $current);
			$stmt->bindParam(':name', $current);
			$stmt->bindParam(':password', $password);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$result || $password != $result['password'])
				return (0);
			return $result;
		} catch (Exception $e) {
			echo 'Exception -> ';
			var_dump($e->getMessage());
		}
	}

	public function createUserSession($user)
	{
		$_SESSION['user'] = $user;
	}
}

$email = $_POST['email'];
$password = $_POST['password'];

if(isset($email) && isset($password))
{
	$password = md5($password);
	$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
	$login = new Login($conn->conn);
	$user = $login->isUserValid($email, $password);
	if($user)
	{
		if($user['account_status'] == 'pending')
		{
			$email = new Email();
			$emailResult = $email->validateAccount($user['name'], $user['email'], $user['token']);
			if($emailResult)
				echo json_encode(array("status" => "Validate your account to login. Check your e-mail"));
			else
				echo json_encode(array("error" => "Something went wrong. Check your infos"));
		}
		else {
			$login->createUserSession($user);
			echo json_encode(array("ok" => true));
		}
	}
	else
		echo json_encode(array("error" => "Something went wrong. Check your infos"));
	exit;
}

?>