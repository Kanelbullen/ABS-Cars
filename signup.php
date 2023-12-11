<script type="text/javascript" src="js\login.js"></script>

<!DOCTYPE html>
<html lang="en">
<body>
<?php include "header.php"; ?>
    <!-- Form Section -->
    <nav class="form">
      <div class="form">
        <form class="signup_form" action="" method="post" name="form">
          <center>
            <div class="font">Username</div>
            <input type="text" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" name="name" required>
            <div class="font">Email</div>
            <input type="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" name="email" required>
            <div class="font">Password</div>
            <input type="password" id="password" name="password" required><br>
            <div class="font">Verify Password</div>
            <input type="password" id="password1" name="password1" required>
            <span id="error">Password is not strong enough</span>
            <span id="errorEmail">Email already exits</span>
            <span id="errorUsername">This username is already used</span>
            <span id="passMatchError">Passwords are not matching</span>
            <br>
            <input type="checkbox" id="show" onclick="showPassword()"><p id="pass">Show password</p>
            <a href="login.php">Already have an account?</a>
            <br>
            <br>
            <input type="submit" name="signup" value="Signup">
          </center>
        </form>
      </div>
    <?php
    // connects to the database
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "abs_cars";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function signup($conn, $name, $email, $password) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }
    $verifyEmail = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($conn));
    $verifyUser = mysqli_query($conn, "SELECT `name` FROM `users` WHERE `name` = '".$_POST['name']."'") or exit(mysqli_error($conn));

    if (isset($_POST['signup'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        // Validate password strength
        $uppercase    = preg_match('@[A-Z]@', $password);
        $lowercase    = preg_match('@[a-z]@', $password);
        $number       = preg_match('@[0-9]@', $password);
        $specialchars = preg_match('@[^\w]@', $password);
        
        if(mysqli_num_rows($verifyUser)) {
          echo '<script type="text/javascript">
          errorUsername();
          </script>';
        } elseif(mysqli_num_rows($verifyEmail)) {
          echo '<script type="text/javascript">
          errorEmail();
          </script>';
        } elseif (!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8) {
          echo '<script type="text/javascript">
          passError();
          </script>'; 
        } elseif ($password != $password1){
          echo '<script type="text/javascript">
          passMatchError();
          </script>';
        } else {
          if (signup($conn, $name, $email, $password)) {
            echo "Signup successful!";
            $_SESSION["email"] = $email;
            header('Location: profile.php');
          } else {
            echo "Error: " . mysqli_error($conn);
          }
        } 
    }

    ?>
    <?php include "footer.php" ?>

    <script type="text/javascript" src="js/app.js"></script>
  </body>

</html>