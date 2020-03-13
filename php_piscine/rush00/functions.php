<?php

function hasItem($itens, $item)
{
	for($i = 0; $i < count($itens); $i++)
	{
		if($itens[$i] == $item['item'])
			return(1);
	}
	return (0);
}
function getItensByCat($categories)
{
	$items = unserialize(file_get_contents('./private/items'));
	$listedItens = array();
	foreach($categories as $category)
	{
		$cat = "cat" . $category;
		foreach($items as $item){
			if(hasItem($listedItens, $item))
				continue;
			if($item[$cat] == "yes")
			{
				getItem($item);
				array_push($listedItens, $item['item']);
			}
		}
	}
}

function getItem($item)
{
			?>
				<div class="item">
				<div class="iteminfo">
					<?php
					echo $item['item'];
					?>
				<p class="little">$<!-- don't delete this dollar sign it's a real dollar sign -->
					<?php
					echo $item['price'];
					?>
				</p>
				<form method="post" name="add.php">
					<p class="little" >qty <input type="number" name="quantity" min="1" max="5" class="count-qtd st-item" item-id="<?php echo $item['id']; ?>" itemName="<?php echo $item['item']?>" price="<?php echo $item['price'] ?>"></p>
					<button name="add" class="add-cart"> Add </button>
				</form></p>
				</div>

				<div class="itemimage">
					<?php
					echo "<img class='img-item' src=\"./images/";
					echo $item['item'];
					echo ".png\" width=200px height=200px>";
					?>
					</div>
				</div>
			<?php
}

function getItemAdmin($item)
{
			?>
				<?php if($item['id'] == 4)
				{
					?>
					<div class="lemon">
						<?php
				}
				else{
					?>
				<div class="item">
				<?php } ?>
				<div class="iteminfo">
				<form method="post" name="save_changes" action="saveItemAdmin.php">
					<input type="hidden" class="item-info" name="itemName" value="<?php echo $item['item']; ?>" 
						item-id="<?php echo $item['id']; ?>">
					<p class="little">Name <input type="text" name="itemRename" class="item-rename" size="6" value="<?php echo $item['item'] ?>"></p>
				<p class="little">Price $
					<input type = "number" width="6" name="newPrice" class="new-price" min="0" value="<?php echo $item['price']; ?>" class="count-qtd st-item" >
				</p>
					<p class="little categories" >
						Categories <br><br>
						<input type="checkbox" name="cat1" <?php if($item['cat1'] == "yes") { echo "checked"; }?>> pointy<br>
						<input type="checkbox" name="cat2" <?php if($item['cat2'] == "yes") { echo "checked"; }?>> yellow<br>
						<input type="checkbox" name="cat3" <?php if($item['cat3'] == "yes") { echo "checked"; }?>> edible
					</p>

					<button name="saveChanges" class="refresh-cart" value="yes"> Save Changes </button>
				</form></p>
				</div>

				<div class="itemimage">
					<?php
					echo "<img src=\"./images/";
					echo $item['item'];
					echo ".png\" width=200px height=200px>";
					?>
					<?php
					if($item['id'] == 4)
					{
						?>
						<a href="item_creator.php"> <span class="little">DELETE </span></a>
					<?php
					}
					?>
					</div>
				</div>
			<?php
}

