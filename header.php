<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ABS Cars</title>
    <link rel="stylesheet" href="styles.css"/>
    <script src="https://kit.fontawesome.com/4d84eb4a24.js" crossorigin="anonymous"></script>
    <!-- Navbar Section -->
    <nav class="navbar">
      <div class="navbar__container">
        <a href="index.php#home" id="navbar__logo">ABS Cars</a>
        <div class="navbar__toggle" id="mobile-menu">
          <span class="bar"></span> <span class="bar"></span>
          <span class="bar"></span>
        </div>
        <ul class="navbar__menu">
          <li class="navbar__item">
            <a href="index.php#home" class="navbar__links" id="home-page">Home</a>
          </li>
          <li class="navbar__item">
            <a href="index.php#about" class="navbar__links" id="about-page">Cars</a>
          </li>
          <li class="navbar__item">
            <a href="index.php#services" class="navbar__links" id="services-page">About Us</a>
          </li>
          <!-- <li class="navbar__btn">
            <a href="add_car.php" class="button">Profile</a>
          </li> -->
          <?php
          error_reporting(0);
          session_start();

          // logout the user and destroys all current imformation
          if (isset($_GET['logout'])){
            unset($_SESSION['email']);
            session_destroy();
            header('location: index.php');
            exit;
          }
          
          if (empty($_SESSION['email'])) {
          ?>
          <li class="navbar__item">
            <a href="login.php" class="navbar__links" id="services-page">Log In</a>
          </li>
          <li class="navbar__btn">
            <a href="signup.php" class="button" id="signup">Sign Up</a>
          <?php
          }
          
          else if (!empty($_SESSION['email'])){
          ?>
          <li class="navbar__btn">
            <a href="profile.php" class="button">Profile</a>
          </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
</head>