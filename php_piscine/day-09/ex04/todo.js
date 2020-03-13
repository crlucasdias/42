function removeTodo(id)
{
	if(confirm("You really want to delete that item?"))
	{
		$.ajax({
        'url' : 'delete.php',
        'type' : 'GET',
        data: { id },
        success : function(data) {
        	data = JSON.parse(data);
        	if(data.error == true)
        		return;
        	else
        		$(`[item-id="${id}"`).remove();
        }});
	}	
}

function insertTodo(value)
{
	$.ajax({
    'url' : 'insert.php',
    'type' : 'GET',
    data: { value },
    success : function(data) {     
     	data = JSON.parse(data);
     	if(!data.error)
       		showTodoElement(data.value, data.id);
     }});
}

function showTodoElement(todo, id)
{
	let list = $("#ft_list").get(0);
	let div = $("<div> </div>");
	let span = $("<span> </span>");
	$(div).addClass("todo-item");
	$(div).attr("item-id", id);
	$(span).text(todo);
	$(div).append(span);
	$(span).on("click", function() { removeTodo(id); });
	$(list).prepend(div);
}

function getAllCsv()
{
	 $.ajax({
        'url' : 'select.php',
        'type' : 'GET',
        success : function(data) {    
        	data = JSON.parse(data); 
        	if(data.error === true)
        		return;       
	        showCsv(data);
        },
    });
}

function showCsv(data)
{
	$(data).each(function(key, elem){
		showTodoElement(elem.value, elem.id);	
	});
}

function isEmpty(value)
{
	if(value.length == 0 || !value.trim())
		return(1);
	return (0);
}


$( document ).ready(function() {
	getAllCsv();
	let addTodo = $(".add-todo").get(0);
	$(addTodo).on("click", function() {
		let todoValue = prompt("Add todo");
		if(todoValue && !isEmpty(todoValue))
			insertTodo(todoValue);
	});
});

