<?php
	include_once ("header.php");
	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
		exit();
	}
?>
	<div class="container main-content">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">My personal data</h5>
            <form class="form-signin">
              <div class="form-label-group">
                  <label for="inputEmail">Username</label>
                <input type="text" id="inputName" class="form-control" placeholder="Name" 
                	value="<?php echo $_SESSION['user']['name']?>" required onfocus="this.value = this.value">
              	<label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required
                value="<?php echo $_SESSION['user']['email']?>">
              </div>

              <div class="form-label-group">
                <label for="inputPassword">Current Password</label>
                <input type="password" id="current-password" class="form-control" placeholder="Password" required>
              	 <label for="inputPassword">New Password</label>
                <input type="password" id="password-1" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Repeat password</label>
                 <input type="password" id="password-2" class="form-control" placeholder="Password" required>
              </div> 
              <div class="form-check check-notifications">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" <?php if($_SESSION['user']['notifications'] == 1) echo "checked"; ?>>
                <label class="form-check-label" for="exampleCheck1"> Notification new comments </label>
              </div>
               <p class="feedback-call"> </p>
              <button class="btn btn-lg btn-primary btn-block text-uppercase btn-u-confirm" type="submit">Save changes</button>
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

  function hasNumber(myString) {
    return /\d/.test(myString);
  }

  function validateData(data)
  {
      let finalData = {};
      let errors = 0;
      finalData.notifications = data.notifications;
      if(data.name.length < 3){
        errors++;
        alert("name to small");
      }
      else
          finalData.name = data.name;
      if(!validateEmail(data.email)){
        errors++;
        alert("invalid email");
      }
      else
          finalData.email = data.email;
      if(data.currentPassword.length >= 2)
      {
          if(data.password1.length < 3 || data.password2.length <3){
            errors++;
            alert("password too small");
          }
          if(data.password1 != data.password2){
            errors++;
            alert("different password");
          }
          if(!hasNumber(data.password1)){
            errors++;
            alert("at least one number");
          }
          if(errors == 0)
          {
            finalData.currentPassword = data.currentPassword;
            finalData.password = data.password1;
          }
      }
      else if(data.currentPassword <= 2 && data.password1.length > 0 || data.password2.length > 0)
          alert("You need your current password to make changes");
      if(errors == 0)
        return(finalData);
      return(0);
  }

  const btn = document.querySelector(".btn-u-confirm");
  btn.addEventListener("click", function(e) {
      e.preventDefault();
      let name = document.querySelector("#inputName").value;
      let email = document.querySelector("#inputEmail").value;
      let currentPassword = document.querySelector("#current-password").value;
      let password1 = document.querySelector("#password-1").value;
      let password2 = document.querySelector("#password-2").value;
      let notifications = document.querySelector(".form-check-input").checked;

      let data = {
          name: name,
          email,
          currentPassword,
          password1,
          password2,
          notifications
      };
      if(data = validateData(data))
      {
          var feedback = document.querySelector('.feedback-call');
          var http = new XMLHttpRequest();
          var url = 'api/save_changes.php';
          var params = `data=${JSON.stringify(data)}`;
          http.open('POST', url, true);

          //Send the proper header information along with the request
          http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

          http.onreadystatechange = function() {//Call a function when the state changes.
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
                      feedback.textContent = "Ok, we save your changes.";
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
