<?php
	include_once ("header.php");
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
            <h5 class="card-title text-center">Forgot password</h5>
            <form class="form-signin">
              <div class="form-label-group">
              	<label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
              </div>
              <p class="feedback-call"> </p>
              <button class="btn btn-lg btn-primary btn-block text-uppercase btn-u-confirm" type="submit">Sign up</button>
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

  function validateErrors(email)
  {
      let errors = 0;
      if(!validateEmail(email)){
        errors++;
        alert("invalid email");
      }
      if(errors == 0)
        return(1);
      return(0);
  }

  const btn = document.querySelector(".btn-u-confirm");
  btn.addEventListener("click", function(e) {
      e.preventDefault();
      let email = document.querySelector("#inputEmail").value;
      var feedback = document.querySelector('.feedback-call');
      if(validateErrors(email))
      {
          var http = new XMLHttpRequest();
          var url = 'api/forgot_password.php';
          var params = `email=${email}`;
          http.open('POST', url, true);

          //Send the proper header information along with the request
          http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

          http.onreadystatechange = function() {//Call a function when the state changes.
              if(http.readyState == 4 && http.status == 200) {
                  const result = JSON.parse(http.responseText);
                      feedback.textContent = "";
                  if(result.error) {
                      feedback.classList.remove("feedback-ok");
                      feedback.classList.add("feedback-error");
                      feedback.textContent = result.error;
                  }
                  else
                  {
                      feedback.classList.remove("feedback-error");
                      feedback.classList.add("feedback-ok");
                      feedback.textContent = "Check your email to get a new password";
                  }
              }
              else if(http.readyState == 4 && http.status != 200) {
                  alert(http.responseText);
              }
          }
          http.send(params);
      }
  });
</script>

</body>
</html>

<!-- corno@gmail.com 12345 --->