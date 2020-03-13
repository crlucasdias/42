<?php
include_once("api/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Camagru</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>

  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
          <?php ?>
    </ul>
    <form class="form-inline">
      <?php if(!isset($_SESSION['user']) || !$_SESSION['user'])
      { ?>
        <a href="login.php" class="btn-header btn btn-outline-success my-2 my-sm-0">
      		Login 
         </a> 
          <a href="register.php" class="btn-header btn btn-outline-success my-2 my-sm-0"> 
      	<!-- <button class="btn btn-outline-success my-2 my-sm-0">-->
      		   Register
         </a>
      <?php } 
      else {
          echo '<ul class="navbar-nav mr-auto"> 
                  <li class="nav-item">
                      <span class="nav-link"> Hello, ' . $_SESSION["user"]["name"] . '</span>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="/add-photo.php">Photos <span class="sr-only">(current)</span></a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="/user_configs.php">Configs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="api/logout.php">Logout</a>
                </li>
                </ul>';
      }
      ?>
  </form>
</nav>
  </div>
</nav>

<script>
  const btnCollapse = document.querySelector(".navbar-toggler");
  btnCollapse.addEventListener("click", function()
  {
    let collapse = this.getAttribute("aria-expanded");
    let navbar = document.querySelector(".navbar-collapse");
    if(collapse === "false")
    {
      this.classList.add("collapsed");
      this.setAttribute("aria-expanded", true);
      navbar.classList.remove("collapse");
    }
    else
    {
      this.classList.remove("collapsed");
      this.setAttribute("aria-expanded", false);
      navbar.classList.add("collapse");
    }
    console.log(this.getAttribute("aria-expanded"));
  })
</script>