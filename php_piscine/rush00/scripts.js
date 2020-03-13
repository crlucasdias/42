
function showLocalStorageCart()
{
	var shop = document.querySelector(".show-cart");
	const cartItens = JSON.parse(localStorage.getItem("cart"));
	if(!cartItens)
		return;
	Object.keys(cartItens).forEach(function(key, index) {
		var element = document.createElement("div");
		element.classList.add("item");
		var innerDiv = document.createElement("div");
		innerDiv.classList.add("iteminfo");
		innerDiv.innerHTML = `
			<p> </p>
			 ${cartItens[key].name} 
			<p class="little"> $ ${cartItens[key].price} <br> <br> count: ${cartItens[key].count}  </p>
			<input type="submit" value="remove" name="${cartItens[key].name}" class="remove-from-cart" onClick="removeFromCart(event, this)">
			</div>
			<div class="itemimage cart-info">
			<img src="${cartItens[key].imgUrl}" width="200px" height="200px"/>
		`
		element.appendChild(innerDiv);
		shop.appendChild(element);
	});
}


function checkItemExistence(name,price)
{
	var itens = document.querySelectorAll(".iteminfo");
	for(let i = 0; i < itens.length; i++)
	{
		if(itens[i].querySelector(".item-info").getAttribute("value") == name)
		{
			if(itens[i].querySelector(".new-price").getAttribute("value") == price)
			{
				location.reload();
				return (0);
			}
		}
	}
	return (1);
}

function refreshItemValue(event,item)
{
	event.preventDefault();
	const id = item.parentElement.querySelector(".item-info").getAttribute("item-id");
	const price = item.parentElement.querySelector(".new-price").value;
	const name = item.parentElement.querySelector(".item-rename").value;
	var info =  {
		id,
		price,
		name
	}
	var itens = JSON.parse(localStorage.getItem("cart"));

	if(!checkItemExistence(name,price))
		return;

	for(var key in itens)
	{
		if(itens[key].id === id)
		{
			info.count = itens[key].count;
			info.imgUrl = 'images/'+name+'.png';
			var previousName = itens[key].name;
			delete itens[key];
			itens[name] = info;
			localStorage.setItem("cart", JSON.stringify(itens));
		}
	}
	$(item).prev().find("input").each(function(index, value) {
		if(value.checked === true)
			info["cat" + index] = 'on';
		else
			info["cat" + index] = 'off';
	});
	if(previousName)
		info.previousName = previousName;
	else
		info.previousName = item.parentElement.querySelector(".item-info").getAttribute("value");
	$.ajax({
        url: "saveItemAdmin.php",
        type: "post",
        data: info,
        success: function (response) {
           // you will get response from your php page (what you echo or print)                 
        },
    });
	//console.log(JSON.parse(localStorage.getItem("cart")));
	//window.location = "/admin-i.php";
}

function dealWithLocalStorageCart(item)
{
	//localStorage.clear();
	//return;
	var itemName = item.querySelector(".st-item").getAttribute("itemName");
	var itens = JSON.parse(localStorage.getItem("cart")); 
	var cart = {};
		if(itens && itens.hasOwnProperty(itemName))
		{
			var total = parseFloat(itens[itemName].count) + parseFloat(item.querySelector(".st-item").value);
			itens[itemName].count = total;
		}
		else 
		{
			cart[itemName] = {
				id: item.querySelector(".st-item").getAttribute("item-id"),
				price: item.querySelector(".st-item").getAttribute("price"),
				count: parseFloat(item.querySelector(".st-item").value),
				name: itemName,
				imgUrl: $(item).parent().next().find("img").attr("src")
			}
		}
		let merged = {...cart, ...itens};
		localStorage.setItem("cart", JSON.stringify(merged));
		getCartCount();
}

function showTotalCart()
{
	var fd = document.querySelector(".total-value");
	var itens = JSON.parse(localStorage.getItem("cart"));
	var total = 0;
	for(var key in itens)
		total += itens[key].count * itens[key].price;
	fd.textContent = total;
	if(total === 0)
		document.querySelector(".feedback-cart").textContent = "Sorry, empty cart";
	else
		document.querySelector(".feedback-cart").textContent = "";
}

function removeAllFromCart()
{
	let itens = document.querySelectorAll(".item");
	if(itens.length == 0){
		localStorage.removeItem("cart");
		document.querySelector(".qtd-cart").textContent = 0;
		window.location = "/index.php";
	}
	else
	{
		for(var i = 0; i < itens.length; i++)
			itens[i].remove();
	}
}

function removeFromCart(event,item)
{
	event.preventDefault();
	var itemValue = item.getAttribute("name");
	var elements = JSON.parse(localStorage.getItem("cart"));
	if(elements[itemValue])
		delete elements[itemValue];
	var cart = { ...elements }
	localStorage.setItem("cart", JSON.stringify(cart));
	removeFromCartHtml(item);
	showTotalCart();
	getCartCount();
}

function removeFromCartHtml(item)
{
	item.closest("div").parentElement.remove();
}

function getCartCount()
{
	var itens = JSON.parse(localStorage.getItem("cart")); 
	let count = 0;
	for(var key in itens)
		count++;
	document.querySelector(".qtd-cart").textContent = count;
}

window.onload = function()
{
	var itens = document.querySelectorAll(".add-cart");
	getCartCount();
	for(var i = 0; i < itens.length; i++)
	{
		itens[i].addEventListener("click", function(event){
			event.preventDefault();
			var item = event.target.parentElement;
			var count = item.querySelector(".count-qtd").value;
			if(count && count > 0)
				dealWithLocalStorageCart(item);
		})
	}
}