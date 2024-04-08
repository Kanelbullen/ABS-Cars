<?php include "header.php"; ?>
<script type="text/javascript" src="js\login.js"></script>
<html lang="en">
<body>
    <!--Form Section-->
    <nav class="form">
      <div class="form">
        <center>
        <form class="login_form" action="" method="post" name="form" onsubmit="return validated()">
          <div class="font">Email</div>
          <input type="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email" required>
          <br>
          <div class="font">Password</div>
          <input type="password" id="password" name="password" required><br>
          <input type="checkbox" id="show" onclick="showPass()"><p id="pass">Show password</p>
          <a href="signup.php">Don't have an account</a>
          <br>
          <span id="error">Password is incorrect</span>
          <span id="errorEmail">This Email doesn't exits</span>
          <br>
          <input type="submit" name="login" value="Login">
        </form>
        </center>
      </div>
    </nav>
  <?php
  // connects to the database
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "mydatabase";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function login($conn, $email, $password) {
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
              header("location: profile.php");
              return true;
            } else {
              return false;
            }
        } else {
            return false;
        }
    }

    $verifyEmail = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($conn));

    if (isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $user_id = $_POST['id'];
      if (login($conn, $email, $password)) {
        echo "Login successful!";
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $user_id;
        header('Location: profile.php');
      }
      elseif(!mysqli_num_rows($verifyEmail)){
        echo '<script type="text/javascript">
        errorEmail();
        </script>';
      }else {
        echo '<script type="text/javascript">
        passError();
        </script>'; 
      }
    }
    
  ?>
  <?php include "footer.php" ?>
    <script type="text/javascript" src="js/app.js"></script>  
  </body>
</html>