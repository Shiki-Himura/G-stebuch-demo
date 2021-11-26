<?php
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="login.php">Gästebuch</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <?php
            $nouser = "<li class='nav-item'>
                        <a class='nav-link text-success' href='login.php'>Login</a>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link text-primary' href='register.php'>Register</a>
                        </li>";
            $loggedin = "<li class='nav-item'>
                          <div class='mt-2'>Willkommen
                            <a id='user-profile' href='#'>".$_SESSION['valid_user']."!</a>
                          </div>
                        </li>
                        <li class='nav-item'>
                          <a class='nav-link text-success' id='logout_user' href='login.php'>Logout</a>
                        </li>";
            if(isset($_SESSION['valid_user']))
            {
              echo($loggedin);
            }
            else
            {
              echo($nouser);
            }
          ?>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>