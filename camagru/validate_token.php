<?php
include_once("header.php");
include_once("api/config/database.php");
include_once("api/HandleDb.php");

if(!isset($_GET['token']))
{
	$result = "Thats not a valid token";
}
else {	
	$token = $_GET['token'];
	$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
	$handleDb = new HandleDb($conn->conn);
	$sql = "SELECT * FROM user WHERE token = '" . $token . "'";
	$result = $handleDb->selectData($sql)[0];
	if($result)
	{	
		if($result['account_status'] == 'pending')
		{
			$result = "Your account is valid now!";
			$newToken = bin2hex(random_bytes(64));
			$sql = "UPDATE user SET account_status = 'confirmed', token = '" . $newToken . "' WHERE token = '" . $token . "'";
			$handleDb->updateData($sql);
		}
		else {
			$result = "Token not valid or account already activated";
		}
	}
	else {
		$result = "Token expired or not valid.";
	}
}

?>

<div class="container main-content">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Token</h5>
            	<p> <?php echo $result ?> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="page-footer font-small special-color-dark pt-4">
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="/index.php"> Camagru </a>
  </div>
</footer>