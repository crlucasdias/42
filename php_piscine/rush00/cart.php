<!-- ========== always stuff ========= -->

<?php
/* ========== header ========= */

include ("header.php");

?>

<!-- ========== cart backend ========== -->

<?php
	$added = FALSE;
	$usercount = 0;
	if(isset($_POST['add']) == 'add'){
		if(!empty($_POST['qty'])){
			$itemarray[]=array('item'=>$_POST['item'], 'price'=>10, 'cat1'=>$_POST['cat1'], 'cat2'=>$_POST['cat2'], 'cat3'=>$_POST['cat3'], 'qty'=>$_POST['qty']);
			if (!empty($_SESSION['cart'])){
				foreach($_SESSION['cart'] as &$cart_item){
					if ($itemarray['item'] == $cart_item['item']){ //if item exists in cart, increase qty
						$cart_item['qty'] = $cart_item['qty'] + $_POST['qty'];
						$added = TRUE;
					}
				}
			}
			if ($added == FALSE)
				$_SESSION['cart'][] = $itemarray;
		}
	}
	if(isset($_POST['add']) == 'add'){
		if(!empty($_POST['qty'])){
			$itemarray=array('item'=>$_POST['item'], 'price'=>10, 'cat1'=>$_POST['cat1'], 'cat2'=>$_POST['cat2'], 'cat3'=>$_POST['cat3'], 'qty'=>$_POST['qty']);
			if (!empty($_SESSION['cart'])){
				foreach($_SESSION['cart'] as &$cart_item){
					if ($itemarray['item'] == $cart_item['item']){ //if item exists in cart, increase qty
						$cart_item['qty'] = $cart_item['qty'] + $_POST['qty'];
						$added = TRUE;
					}
				}
			}
			if ($added == FALSE)
				$_SESSION['cart'][] = $itemarray;
		}
	}

?>

<!-- ========== cart display ========== -->

<div>
<a href="#" class="clean-cart">click to finish your order</a><p>
</div>
<div class="shop show-cart">
	<h2> Your cart: </h2>
	<h2 class="total-price"> Total: $ <span class="total-value">0</span> </h2>
	<h2 class="feedback-cart"></h2>
<?php
/* if(isset($_SESSION['cart']))
{
	$cart = $_SESSION['cart'];
	foreach($cart as $item){
		echo "<div class=\"item\">";
		echo "<div class=\"iteminfo\">";
		echo $item['item'];
		echo "<p class=\"little\">$";
		echo $item['price'];
		echo "</p>";
		echo "<p class=\"little\">qty ";
		echo $item['qty'];
		echo "</p>";
		echo "<input type=\"submit\" value=\"remove\" name=\"add to cart\"></form></p>";
		echo "</div>";

		echo "<div class=\"itemimage\">";
		echo "<img src=\"./images/";
		echo $item['item'];
		echo ".png\" width=200px height=200px>";
		echo "</div>";
		echo "</div>";
	}
} */	
?>
</div>
<script>

	window.onload = function()
	{
		showLocalStorageCart();
		showTotalCart();
		getCartCount();

		var emptyCart = document.querySelector(".clean-cart");
		emptyCart.addEventListener("click", function(){
			removeAllFromCart();
			localStorage.removeItem("cart");
			showTotalCart();
			getCartCount();
		});

		/*var finishOrder = document.querySelector(".finishOrder");
		emptyCart.addEventListener("click", function(){
			removeAllFromCart();
			localStorage.removeItem("cart");
			showTotalCart();
		});
		*/
	}


</script>
</body>

<!--
		<div class=item>
		<div class=iteminfo>
		<p class=little>	
		</p>
		<p class=little>qty 
		</p>
		<input type=submit value=remove name=add to cart></form></p>
		</div>
		<div class=itemimage>
		<img src="./images/"
		".png width=200px height=200px>
		</div>
		</div>
-->
</html>