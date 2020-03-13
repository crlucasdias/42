<?php
include_once("config/database.php");
include_once("HandleDb.php");



if(!isset($_FILES['files']['name'][0]) && !isset($_POST))
{
	echo json_encode(array("error" => "no image"));
	return;
}



$file_name = uniqid();
$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
$handleDb = new HandleDb($conn->conn);

if(!empty($_FILES))
	createUploadFile($file_name, $handleDb);
else if(!empty($_POST))
	createCameraFile($file_name, $handleDb);



function photoIntoDb($destination, $handleDb)
{
	$data = array("user_id" => $_SESSION['user']['id'], "src" => $destination);
	$handleDb->insertData("post", array("user_id", "src"), $data);
	$get = $handleDb->selectData("SELECT * from post WHERE src = '". $destination . "'");
	echo json_encode(array("ok" => true, "src" => $destination, "post_id" => $get[0]["id"]));
}

function createCameraFile($file_name, $handleDb)
{
	if(isset($_POST['img'])) {
		$img = $_POST['img'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$destination = "../uploads/" . $file_name . ".png";
		file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $file_name . ".png", $data);	
		photoIntoDb($destination, $handleDb);
	}
	else
		echo json_encode(array("error" => "Something went wrong"));
}


function createUploadFile($file_name, $handleDb)
{
	$t = $_FILES['files']['name'][0];
	$file_tmp = $_FILES['files']['tmp_name'][0];
	$file_type = $_FILES['files']['type'][0];
	$file_size = $_FILES['files']['size'][0];
	$k = explode('.', $_FILES['files']['name'][0]);
	$file_ext = strtolower(end($k));

	$destination = "../uploads/" . $file_name. "." . $file_ext;
	$allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

	if(!in_array($file_ext, $allowedExtensions))
		echo "Extension not allowed";

	else
	{
		if(move_uploaded_file($file_tmp, $destination))
			photoIntoDb($destination, $handleDb);
		else {
			echo json_encode(array("error" => "Something went wrong"));
		}
	}
}

?>