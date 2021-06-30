<html lang="<?=$strings['lang']?>" dir="<?=$strings['dir']?>">
  <head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Auth Ecommerce</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link href="./assets/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="./assets/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

  </style>
<link href="./assets/style.css" rel="stylesheet" id="styles-css">
</head>
  <body>
  
<!------ Include the above in your HEAD tag ---------->

<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<!-- navbar -->
<!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="<?=$defines['site_url']?>" >
        <strong class="blue-text">Auth</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="<?=$defines['site_url']?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="#" >Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="#"
              >About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="#" >Free
              Contacts</a>
          </li>
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <?php if (get_user_login()) { ?>
          <li class="nav-item">
            <a href="<?=$defines['site_url']?>profile" class="nav-link border border-light rounded waves-effect"
              >
              <i class="fab fa-github mr-2"></i>Profile
            </a>
          </li>
          <li class="nav-item mx-2">
            <a href="<?=$defines['site_url']?>actions/logout" class="nav-link border border-light rounded waves-effect"
              >
              <i class="fab fa-github mr-2"></i>Logout
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="<?=$defines['site_url']?>login" class="nav-link border border-light rounded waves-effect"
              >
              <i class="fab fa-github mr-2"></i>Login
            </a>
          </li>
          <li class="nav-item mx-2">
            <a href="<?=$defines['site_url']?>register" class="nav-link border border-light rounded waves-effect"
              >
              <i class="fab fa-github mr-2"></i>Register
            </a>
          </li>
          <?php } ?>
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->
<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?=$strings['Navbar']?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav <?=$strings['Navbar_auto']?>">
      <li class="nav-item active">
        <a class="nav-link" href="<?=$defines['site_url']?>"><?=$strings['Home']?> <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?=$strings['Link']?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?=$strings['Dropdown']?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><?=$strings['Action']?></a>
          <a class="dropdown-item" href="#"><?=$strings['Another action']?></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#"><?=$strings['Something else here']?></a>
        </div>
        
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$defines['site_url']?>change_lang"><?=$strings['change_lang']?></a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
    <?php if (get_user_login()) { ?>
      <a class="btn btn-outline-success my-2 my-sm-0" href="<?=$defines['site_url']?>profile"><?=$strings['Profile']?></a>
      <a class="btn btn-outline-alert my-2 my-sm-0" href="<?=$defines['site_url']?>actions/logout" ><?=$strings['Logout']?></a>
      <?php } else { ?>
      <a class="btn btn-outline-success my-2 my-sm-0" href="<?=$defines['site_url']?>login"><?=$strings['Login']?></a>
      <?php } ?>
      
    </div>
  </div>
</nav>-->
<!-- navbar -->