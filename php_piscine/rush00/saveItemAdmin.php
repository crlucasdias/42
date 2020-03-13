
<?php
	$itemArray = unserialize(file_get_contents('./private/items'));

	if(isset($_POST['price']))
		$_POST['newPrice'] = $_POST['price'];
	if(isset($_POST['name']))
		$_POST['itemRename'] = $_POST['name'];
	if(isset($_POST['previousName']))
		$_POST['itemName'] = $_POST['previousName'];
		if(isset($_POST['itemRename']))
		{
			foreach($itemArray as &$item){
				if(!isset($_POST['itemName']))
				break;
				if($item['item'] == $_POST['itemName']){
					$item['item'] = $_POST['itemRename'];
					// rename('images/'.$_POST['previousName'].".png", 'images/'.$_POST['itemRename'] .'.png');
				}
			}
		}
		if(isset($_POST['newPrice']))
		{
			foreach($itemArray as &$item){
				if($item['item'] == $_POST['itemName']){
					$item['price'] = $_POST['newPrice'];
				}
			}
		}
		if(isset($_POST['cat1']) || isset($_POST['cat2']) || isset($_POST['cat3']))
		{

			foreach($itemArray as &$item){
			if(!isset($_POST['itemName']))
				break;
				if($item['item'] == $_POST['itemName']){
					print_r($item);
					if($_POST['cat1'] == 'on')
						$item['cat1'] = 'yes';
					else
						$item['cat1'] = '';
					if($_POST['cat2'] == 'on')
						$item['cat2'] = 'yes';
					else
						$item['cat2'] = '';
					if($_POST['cat3'] == 'on')
						$item['cat3'] = 'yes';
					else
						$item['cat3'] = '';
				}
			}
			unset($item);
		}
		file_put_contents('./private/items', serialize($itemArray));
		header("Location: http://localhost:" . $_SERVER['SERVER_PORT'] . "/admin-i.php");
		die();
?>