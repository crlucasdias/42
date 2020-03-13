<?php

session_start();
?>
<div class="item">
	<div class="iteminfo">
		Add New Item
	<form method="post" action="" name="save_changes">
		<p class="little">Name <input type="text" size="6" name="itemName" value="thing5"></p>
	<p class="little">Price $
		<input type = "number" width="6" name="newPrice" min="0" value="0">
	</p>
		<p class="little" >
			Categories <br><br>
			<input type="checkbox" name="cat1"> pointy<br>
			<input type="checkbox" name="cat2"> yellow<br>
			<input type="checkbox" name="cat3"> edible
		</p>
		
		<div class="itemimage">
			<img src="./images/thing5.png" width=200px height=200px>
			</div>
		</div>
	<button name="submit" class="add-cart" value="saveChanges"> Save Changes </button>
	</form></p>
	</div>
<?php

if (isset($_POST['submit']))
{
	print_r($_POST);
	echo "<br><br>";
	if($_POST['cat1'] == 'on')
	{
		$_POST['cat1'] = 'yes';
	}
	else{
		$_POST['cat1'] = '';
	}
	if($_POST['cat2'] == 'on')
	{
		$_POST['cat2'] = 'yes';
	}
	else{
		$_POST['cat2'] = '';
	}
	if($_POST['cat3'] == 'on')
	{
		$_POST['cat3'] = 'yes';
	}
	else{
		$_POST['cat3'] = '';
	}
	print_r($_POST);
	$newitem = array('id' => 4, 'item' => $_POST['itemName'], 'price' => $_POST['newPrice'], 'cat1' => $_POST['cat1'], 'cat2' => $_POST['cat2'], 'cat3' => $_POST['cat3']);
	$itemArray = unserialize(file_get_contents('./private/items'));
	array_push($itemArray, $newitem);
	file_put_contents('./private/items', serialize($itemArray));
	
	header("Location: http://localhost:". $_SERVER['SERVER_PORT'] .  "/admin-i.php");
	die();
}

?>