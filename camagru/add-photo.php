<?php
	include_once ("header.php");
  include_once ("api/gallery.php");
  if(!isset($_SESSION['user']))
  {
    header("Location: index.php");
    return;
  }

?>

	<div class="container main-content">
    <div class="row">
      <div class="col-sm-12 col-md-8 col-lg-8 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Add photo</h5>
            <video class="video-upload">
            </video>
            <canvas class="hidden video-upload"> </canvas>
            <div class="hidden"> </div>
            <h3> Emoticons <i class="fa fa-camera" aria-hidden="true"></i> </h3>
            <div>
              <img src="uploads/happy.png" class="emoticon em-1"/>
              <img src="uploads/angry.png" class="emoticon"/>
              <img src="uploads/confused.png" class="emoticon"/>
            </div>
            <span class="btn btn-default btn-file">
                  <input type="file" id="imgInp"  accept="image/*" capture="camera">
            </span>
            <p class="feedback-call"> </p>
            <button type="submit" class="btn btn-success post-photo"> Post photo </button>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12 my-5">
        <div class="card card-signin">
          <div class="card-body">
            <h2 class="my-glry"> My gallery </h2>
            <div class="list-itens-gallery">
            <?php
            
              if(!empty($_SESSION['user']))
              {
                $result = getUserGallery($_SESSION['user']['id'], $handleDb);
                if(!$result)
                  echo "<br>";
                else
                  printImages($result);
              }
              else
                echo "<br> <h5> Sign in to see your gallery </h5>";
              ?>
            </div>
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

<script>

  /*
  obrigatoriamente tem q ter uma imagem superblablabal*/

/* web cam */


 function removeElements(elements)
  {
      for(var i = 0; i < elements.length; i++)
          elements[i].remove();
  }

  function startListeners()
  {
    const removeGalleryItem = document.querySelectorAll(".remove-gallery");
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
                          console.log(feedback.error);
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
  }

  function isCanvasEmpty(canvas)
  {
    if(canvas.classList.contains("hidden"))
      return(true);
    return (false);
  }


 function handleFilter(elem)
 {

    let canvas = document.querySelector("canvas");
    context = canvas.getContext('2d');
    base_image = new Image();
    base_image.src = canvas.toDataURL;
    context.drawImage(base_image, 0, 0, canvas.width, canvas.height);
    base_image.src = elem.src;
    context.drawImage(base_image, (canvas.width - elem.offsetWidth) * 0.45 , 
      (canvas.height - elem.offsetHeight) * 0.45, elem.offsetWidth * 2, elem.offsetHeight * 2);
 }

function addPicture(img_result, id)
{
  var nDiv = document.createElement("div");
  nDiv.classList.add("col-md-12");
  nDiv.classList.add("col-xs-12");
  nDiv.classList.add("the-gallery");
  nDiv.setAttribute("post-id", id);
  var img = document.createElement("img");
  img.src = img_result;
  img.classList.add("picture-gallery");
  var a = document.createElement("a");
  a.href = "#";
  a.classList.add("gallery-item");
  a.classList.add("remove-gallery");
  a.textContent = "Remove image";
  a.setAttribute("post-id", id);
  nDiv.appendChild(img);
  nDiv.appendChild(a);
  document.querySelector(".list-itens-gallery").prepend(nDiv);
  startListeners();
}
 /*function recreateCanvas(context, width, height)
 {
    let canvas = document.createElement("canvas");
    canvas.classList.add("video-upload");
    canvas.width = width;
    canvas.height = height;
    canvas.getContext("2d").drawImage(context.canvas, 0, 0, width, height);
    let oldCanvas = document.querySelector("canvas");
    oldCanvas.parentNode.insertBefore(canvas, oldCanvas.nextSibling);
    oldCanvas.parentNode.removeChild(oldCanvas);
    return canvas;
 }*/

function showCamera(video)
{
    navigator.mediaDevices.getUserMedia({video: true})
   .then(function(mediaStream)
   {
        window.stream = mediaStream;
        video.srcObject = mediaStream;
        video.play();
    }).catch(error => console.error('getUserMedia() error:', error));
}

 function takeSnapshot(video){
    let canvas = document.querySelector("canvas");
    let width = video.offsetWidth;
    let height = video.offsetHeight;
    let context = canvas.getContext('2d');

    canvas.width = width;
    canvas.height = height;
    context.clearRect(0, 0, width, height);
    context.drawImage(video, 0, 0, width, height);
    canvas.classList.remove("hidden");
    canvas.toDataURL("image/png");
/*
    var hidden_canvas = document.querySelector('canvas'),
        video = document.querySelector('.video-upload'),
        image = document.querySelector('img.photo'),

        width = video.videoWidth,
        height = video.videoHeight,

        // Context object for working with the canvas.
        context = hidden_canvas.getContext('2d');

    // Set the canvas to the same dimensions as the video.
    hidden_canvas.width = width;
    hidden_canvas.height = height;

    // Draw a copy of the current frame from the video on the canvas.
    context.drawImage(video, 0, 0, width, height);

    // Get an image dataURL from the canvas.
    var imageDataURL = hidden_canvas.toDataURL('image/png');

    // Set the dataURL as source of an image element, showing the captured photo.
    image.setAttribute('src', imageDataURL); 
*/
}

window.onload = function() {
    var video = document.querySelector(".video-upload");
    showCamera(video);
    var takePic = document.querySelector(".fa-camera");
    var emoticon = document.querySelectorAll(".emoticon");
    let counterFilter = 0;


   takePic.addEventListener("click", function(e) {
      e.preventDefault;
      takeSnapshot(video);
      counterFilter = 0;
   })

   for (var i = 0; i < emoticon.length; i++)
   {
      emoticon[i].addEventListener("click", function(e){
          e.preventDefault();
          handleFilter(this);
          counterFilter = 1;
      })
   }

  const btnPhoto = document.querySelector(".post-photo");
  startListeners();

  btnPhoto.addEventListener("click", function(e){
      e.preventDefault();
      const file = document.querySelector('#imgInp').files[0];
      const feedback = document.querySelector('.feedback-call');
      const canvas = document.querySelector("canvas");
      let img_type = "";

      
      var http = new XMLHttpRequest();
      var url = 'api/upload_picture.php';
      http.open('POST', url, true);
          if(isCanvasEmpty(canvas))
          {
            formData = new FormData();
            formData.append('files[]', file);
            formData.type = "file";
            img_type = "file";
          }
          else
          {
            if(counterFilter == 0)
            {
                feedback.classList.remove("feedback-ok");
                feedback.classList.add("feedback-error");
                feedback.textContent = "Please, select a superposable image";
                http.abort();
                return;
            }
            formData = `type=camera&img=${canvas.toDataURL()}`;
            img_type = "camera";
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
          }
          http.onreadystatechange = function(result) {//Call a function when the state changes.
              feedback.textContent = "";
              if(http.readyState == 4 && http.status == 200) {
                  const result = JSON.parse(http.responseText);
                  feedback.textContent = "";
                  if(result.error)
                  {
                      feedback.classList.remove("feedback-ok");
                      feedback.classList.add("feedback-error");
                      feedback.textContent = result.error;
                  }
                  else
                  {
                      feedback.classList.remove("feedback-error");
                      feedback.classList.add("feedback-ok");
                      feedback.textContent = "Image uploaded";
                      addPicture(result.src, result.post_id);
                      if(img_type == "camera")
                      {
                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                        canvas.classList.add('hidden');
                        counterFilter = 0;
                      }
                  }
                  img_type = "";
              }
              else if(http.readyState == 4 && http.status != 200) {
                alert(http.responseText);
              }
          }
          http.send(formData);
  })
}


</script>

</body>
</html>