<?php
	include_once ("header.php");
	include_once ("api/gallery.php");
  include_once("api/Email.php");
  //$email = new Email();
  //$emailResult = $email->validateAccount("joao", "lucasdias.blend@gmail.com", "213912319");
  //var_dump($emailResult);
?>


	<div class="container main-content">
		<div class="row">
			<div class="col-md-10 col-xs-12 main-pics">
				<h1> Gallery </h1>
				<?php
					$result = getAllUsers($handleDb, 0);
					if($result)
            printImages_half($result, $handleDb);
				?>
			</div>
			<!--<div class="col-md-4">
				<h2> My gallery </h2>-->
				<?php
        /*
					if(!empty($_SESSION['user']))
					{
						$result = getUserGallery($_SESSION['user']['id'], $handleDb);
						if(!$result)
							echo "<br> <h5> No pictures yet </h5>";
						else
						  printImages($result);
					}
					else
						echo "<br> <h5> Sign in to see your gallery </h5>";
            */
				?>
			<!-- </div> -->
		</div>
	</div>
  <footer class="page-footer font-small special-color-dark pt-4">
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="/index.php"> Camagru </a>
  </div>
</footer>
</body>

<script>

function addComment(element, currentText, author)
{
  let newElement = document.createElement("p");
  newElement.textContent = author + " - " + currentText;
  newElement.classList.add("comment");
  element.parentNode.querySelector(".comments-table").appendChild(newElement);
}

function removeElements(elements)
{
    for(var i = 0; i < elements.length; i++)
        elements[i].remove();
}


function startListeners()
{
      const thumbsUp = document.querySelectorAll(".add-like");
      const thumbsDown = document.querySelectorAll(".remove-like");
      const removeGalleryItem = document.querySelectorAll(".remove-gallery");
      const sendComment = document.querySelectorAll(".send-comment");
      for(var i = 0; i < thumbsUp.length; i++)
      {
      	thumbsUp[i].addEventListener("click", function() {
      		  var http = new XMLHttpRequest();
                var url = 'api/likes.php';
                var post_id = this.getAttribute("post-id");
                var params = `type=likes&post_id=${post_id}`;
                const current = this;
                http.open('POST', url, true);

                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function(e) {//Call a function when the state changes.
                    if(http.readyState == 4 && http.status == 200) {
                    	  const feedback = JSON.parse(http.responseText);
                    	  if(feedback.error)
                    	  {
                    	  		alert(feedback.error);
                    	  }
                    	  else
                    	  {
      	                  let value = parseInt(current.textContent) + 1;
      					  current.textContent = value;
      				  }
                    }
                    else if(http.readyState == 4 && http.status != 200) {
                        alert(http.responseText);
                    }
                }
                http.send(params);
      	});
      }

      for(var i = 0; i < thumbsDown.length; i++)
      {
      	thumbsDown[i].addEventListener("click", function() {
      		  var http = new XMLHttpRequest();
                var url = 'api/likes.php';
                var post_id = this.getAttribute("post-id");
                var params = `type=deslikes&post_id=${post_id}`;
                const current = this;
                http.open('POST', url, true);

                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function(e) {//Call a function when the state changes.
                    if(http.readyState == 4 && http.status == 200) {
                    	  const feedback = JSON.parse(http.responseText);
                    	  if(feedback.error)
                    	  {
                    	  		alert(feedback.error);
                    	  }
                    	  else
                    	  {
      	                  let value = parseInt(current.textContent) + 1;
      					  current.textContent = value;
      				  }
                    }
                    else if(http.readyState == 4 && http.status != 200) {
                        alert(http.responseText);
                    }
                }
                http.send(params);
      	});
      }

      for(var i = 0; i < removeGalleryItem.length; i++)
      {
      	removeGalleryItem[i].addEventListener("click", function () {
      		      var http = new XMLHttpRequest();
                var url = 'api/deleteImage.php';
                var post_id = this.getAttribute("post-id");
                var params = `post_id=${post_id}`;
                http.open('POST', url, true);

                //Send the proper header information along with the request
                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function(e) {//Call a function when the state changes.
                    if(http.readyState == 4 && http.status == 200) {
                    	  const feedback = JSON.parse(http.responseText);
                    	  console.log(feedback);
                    	  if(feedback.error)
                    	  		alert(feedback.error);
                    	  else
      	                {
                          removeElements(document.querySelectorAll(`div[post-id='${post_id}']`));
                        }
                    }
                    else if(http.readyState == 4 && http.status != 200) {
                        alert(http.responseText);
                    }
                }
                http.send(params);
      	});
      }

      for(var i = 0; i < sendComment.length; i++)
      {
        sendComment[i].addEventListener("click", function (e) {
              e.preventDefault();
              const msg = this.parentNode.querySelector(".add-comment").value;
              if(msg.length <= 1)
              {
                  alert("Too short.");
                  return;
              }
              else
              {
                  var http = new XMLHttpRequest();
                  var url = 'api/add_comment.php';
                  var post_id = this.parentNode.getAttribute("post-id");
                  var params = `post_id=${post_id}&comment=${msg}`;
                  const elem = this;
                  http.open('POST', url, true);

                  //Send the proper header information along with the request
                  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  http.onreadystatechange = function(e) {//Call a function when the state changes.
                      if(http.readyState == 4 && http.status == 200) {
                          const feedback = JSON.parse(http.responseText);
                          if(feedback.error)
                              alert(feedback.error);
                          else
                          {
                              elem.parentNode.querySelector(".add-comment").value = '';
                              addComment(elem, msg, feedback.author);
                          }
                      }
                      else if(http.readyState == 4 && http.status != 200) {
                          alert(http.responseText);
                      }
                  }
                  http.send(params);
                }
        });
      }
}

startListeners();

let scrolling = false;
let last_string = "";
let counter = 5;

window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !scrolling) {
            scrolling = true;
            var http = new XMLHttpRequest();
            var url = 'api/get_more.php';
            var params = `count=${counter}`;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            http.onreadystatechange = function(e) {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                      if(http.responseText){
                        let txt = "";
                        txt = http.responseText.replace('{"ok":true}', "");
                        document.querySelector(".main-pics").innerHTML += txt;
                        startListeners();
                        if(txt.length > 0)
                        {
                          counter += 5;
                          txt = "";
                        }
                      }
                   // scrolling = false;
                }
                else if(http.readyState == 4 && http.status != 200) {
                    alert(http.responseText);
                    //scrolling = false;
                }
            }
            http.send(params);
            setInterval(function() {
              scrolling = false;
            }, 1000);
    }
};

</script>
</html>