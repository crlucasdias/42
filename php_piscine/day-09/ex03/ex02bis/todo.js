/*
To work with cookies, we need to access by localhost.
*/

function generateId()
{
	return Math.random().toString(36).substr(2, 9);
}

function showCookiesList()
{
	let cookies = document.cookie;
	let currentCookie;
	let tmp_str = "";
	cookies = cookies.split("; ");
	for(var i = 0; i < cookies.length; i++)
	{
		currentCookie = cookies[i].split("=");
		for(var j = 1; j < currentCookie.length; j++)
		{
			tmp_str += decodeURIComponent(currentCookie[j]);
			if(currentCookie.length > 1 && j != currentCookie.length - 1)
				tmp_str += '=';
		}
		if(currentCookie.length == 1)
			tmp_str = currentCookie[0];
		insertTodo(tmp_str, currentCookie[0]);
		tmp_str	 = "";
	}
}

function handleCookie(value, action, id)
{
	let todo;
	let expires;
	if(action == "add")
	{
		expires = "expires=Fri, 31 Dec 9999 23:59:59 GMT";
		value = encodeURIComponent(value);
		todo = `${id}=${value}; ${expires};`;
	}
	else if(action == "del")
	{
		expires = "";
		todo = `${id}=; expires=Thu, 01 Jan 1970 00:00:01 GMT;`;
	}
	document.cookie = todo;
}

function insertTodo(todo, id)
{
	let list = $("#ft_list").get(0);
	let div = $("<div> </div>");
	let span = $("<span> </span>");
	$(div).addClass("todo-item");
	$(div).attr("item-id", id);
	$(span).text(todo);
	$(div).append(span);
	$(span).on("click", function() { removeTodo(div); });
	$(list).prepend(div);
}

function removeTodo(todo)
{
	if(confirm("You really want to delete that item?"))
	{
		$(todo).remove();
		handleCookie(todo, "del", $(todo).attr("item-id"));
	}	
}

function isEmpty(value)
{
	if(value.length == 0 || !value.trim())
		return(1);
	return (0);
}

$( document ).ready(function() {
	if(document.cookie.length > 0)
		showCookiesList();
	let addTodo = $(".add-todo").get(0);
	$(addTodo).on("click", function() {
		let todoValue = prompt("Add todo");
		if(todoValue && !isEmpty(todoValue))
		{
			let id = generateId();
			insertTodo(todoValue, id);
			handleCookie(todoValue, "add", id);
		}	
	});
});

