<?php
  include_once("header.php");
if(isset($_SESSION['user']))
{
  header("Location: index.php");
  return;
}
  ?>
	<div class="container main-content">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <label for="inputEmail">Email or username</label>
                <input type="email" id="inputEmail" class="form-control acc-mail" placeholder="Email or username" required autofocus>
              </div>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control acc-pass" placeholder="Password" required>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <h6> <a href="/forgot_password.php"> forgot-password </a> </h6>
              </div>
               <p class="feedback-call"> </p>
              <button class="btn btn-lg btn-primary btn-block text-uppercase btn-u-confirm" type="submit">Sign in</button>
            </form>
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

   function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }

  function validateErrors(email, password)
  {
      let errors = 0;
      if(email.length <= 1)
        alert("login info too small");
      /*if(!validateEmail(email)){
        errors++;
        alert("invalid email");
      }*/
      if(password.length < 3){
        errors++;
        alert("password too small");
      }
      if(errors == 0)
        return(1);
      return(0);
  }


  const btn = document.querySelector(".btn-u-confirm");
  btn.addEventListener("click", function(e){
      e.preventDefault();
      let email = document.querySelector(".acc-mail").value;
      let password = document.querySelector(".acc-pass").value;
      var feedback = document.querySelector('.feedback-call');
              
      if(validateErrors(email, password))
      {
          var http = new XMLHttpRequest();
          var url = 'api/login.php';
          var params = `email=${email}&password=${password}`;
          http.open('POST', url, true);

          //Send the proper header information along with the request
          http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

          http.onreadystatechange = function() {//Call a function when the state changes.
              if(http.readyState == 4 && http.status == 200) {
                  feedback.textContent = "";
                  const result = JSON.parse(http.responseText);
                  if(result.error)
                  {
                      feedback.classList.remove("feedback-ok");
                      feedback.classList.add("feedback-error");
                      feedback.textContent = result.error;
                  }
                  else if(result.status)
                  {
                      feedback.classList.remove("feedback-ok");
                      feedback.classList.add("feedback-error");
                      feedback.textContent = result.status;
                  }
                  else
                    window.location.href = 'index.php';
              }
              else if(http.readyState == 4 && http.status != 200) {
                  alert(http.responseText);
              }
          }
          http.send(params);
      }
  })
</script>
</body>
</html>