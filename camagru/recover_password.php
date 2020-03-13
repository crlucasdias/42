<?php
include_once("header.php");
include_once("api/config/database.php");
include_once("api/HandleDb.php");

if(!isset($_GET['token']))
{
	$msg = "Thats not a valid token";
}
if(isset($_SESSION['user']))
{
  header("Location: index.php");
  return;
}

else {	
  if(isset($_GET['token']))
  {
  	$token = $_GET['token'];
  	$conn = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
  	$handleDb = new HandleDb($conn->conn);
  	$sql = "SELECT token FROM user WHERE token = '" . $token . "'";
  	$result = $handleDb->selectData($sql)[0];
  	if(!$result)
  		$msg = "Token expired or not valid.";
  }
  else
    $msg = "Token expired or not valid.";
}

?>

<div class="container main-content">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Recover password</h5>
            <?php if(!isset($msg)) { ?>
		            <form class="form-signin">
		              <div class="form-label-group">
		                <label for="inputEmail">New password</label>
		                <input type="password" id="password-1" class="form-control acc-mail" placeholder="Password" required autofocus>
		              </div>

		              <div class="form-label-group">
		                <label for="inputPassword">Repeat Password</label>
		                <input type="password" id="password-2" class="form-control acc-pass" placeholder="Repeat Password" required>
		              </div>
		               <p class="feedback-call"> </p>
		              <button class="btn btn-lg btn-primary btn-block text-uppercase btn-u-confirm" type="submit">Save changes</button>
		            </form>
	         <?php }
           else { ?>
              <p> Token expired or not valid. </p>
            <?php } ?>
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

  function hasNumber(myString) {
      return /\d/.test(myString);
  }
  function validateErrors(password1, password2)
  {
      let errors = 0;
      if(password1.length < 3 || password2.length <3){
        errors++;
        alert("password too small");
      }
      if(password1 != password2){
        errors++;
        alert("different password");
      }
      if(!hasNumber(password1))
      {
        errors++;
        alert("at least one number");
      }
      if(errors == 0)
        return(1);
      return(0);
  }


  const btn = document.querySelector(".btn-u-confirm");
  btn.addEventListener("click", function(e) {
      e.preventDefault();
  	  let password1 = document.querySelector("#password-1").value;
      let password2 = document.querySelector("#password-2").value;
      var feedback = document.querySelector('.feedback-call');

      if(validateErrors(password1, password2))
      {
      	  var http = new XMLHttpRequest();
          var url = 'api/recover_password.php';
          var params = `password=${password1}&token=<?php echo $token?>`;
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
                      feedback.textContent = "Password changed!";
                  }
              }
              else if(http.readyState == 4 && http.status != 200) {
                  alert(http.responseText);
              }
          }
          http.send(params);
      }
      else
         feedback.textContent = "";
  });

</script>

</body>
</html>