<script type="text/javascript" src="js\login.js"></script>

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

        //logout the user and destroys all current imformation
        if (isset($_GET['logout'])){
            unset($_SESSION['email']);
            session_destroy();
            header('location: index.php');
            exit;
        }

        // checks if user is logged in. if not it takes the user to login page. 
        if (empty($_SESSION['email'])){
            echo "User is not logged in";
            header('location: login.php');
            exit;
        }

        $user_id = $_SESSION['id'];

        // Retrieve cars owned by the user
        $cars_query = "SELECT * FROM cars INNER JOIN user_cars ON cars.id = user_cars.car_id WHERE user_cars.user_id = '$user_id'";
        $cars_result = mysqli_query($conn, $cars_query);

        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $data = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($data);
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        $id = $_SESSION['id'];
        $_SESSION['profile_img'] = $row['profile_img'];
        

        if (isset($_FILES['profile_img']['name']) AND !empty($_FILES['profile_img']['name'])) {
         
         
            $img_name = $_FILES['profile_img']['name'];
            $tmp_name = $_FILES['profile_img']['tmp_name'];
            $error = $_FILES['profile_img']['error'];
            
            if($error === 0){
               $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
               $img_ex_to_lc = strtolower($img_ex);
   
               $allowed_exs = array('jpg', 'jpeg', 'png');
               if(in_array($img_ex_to_lc, $allowed_exs)){
                  $new_img_name = uniqid($_SESSION['name'], true).'.'.$img_ex_to_lc;
                  $img_upload_path = './upload/'.$new_img_name;
                  move_uploaded_file($tmp_name, $img_upload_path);
   
                  // Insert into Database
                  $sql = "UPDATE users SET profile_img='$new_img_name' WHERE id=$id";
                  if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                  } else {
                    echo "Error updating record: " . $conn->error;
                  }
   
                  header("Location: profile.php?success=Your account has been created successfully");
                   exit;
               }else {
                //   $em = "You can't upload files of this type";
                  header("Location: ../index.php");
                  exit;
               }
            }
        }

        ?>
<head>
    <?php include "header.php"; ?>
</head>
<body>
    <div class="profile">	
        <form class="profile_form" id="profile_form" action="" method="post" name="form_img"
        enctype="multipart/form-data">
            <div class="font">Profile Image</div>
            <img src = "upload/<?=$_SESSION['profile_img']?>" id="profile_img">
            <img src = "upload/<?=$_SESSION['profile_img']?>" id="edit_profile_img" onclick="image_click()";>
            <input type="file" id="file" name="profile_img" onchange="this.form.submit();" accept="image/png, image/jpeg, image/jpg">
        <div>
        </div>
        <h3 class="h3">Username: <?=$_SESSION['name']?></h3>
        <h3 class="h3">Email: <?=$_SESSION['email']?></h3>
        <div class="button_pro">
            <!-- <button type="submit" id="img_sub"> update profile image</button> -->
            <button id="img_sub" onclick="edit_profile()" type="button">Edit Profile</button>
            <a href="?logout=true" class="logout">logout</a>
        </div>
        </form>   
    </div>

    <div class="services__wrapper">
        <div class="services__card">
        <?php
            if (mysqli_num_rows($cars_result) > 0) {
                // Display owned cars
                while ($car_row = mysqli_fetch_assoc($cars_result)) {
                    echo '
                            <img src="' . $car_row['image'] . '" alt="Car" class="services__img">
                            <h1>' . $car_row['name'] . '</h1>
                            <h2>' . $car_row['price'] . 'kr' . '</h2>
                            <h3>' . $car_row['description'] . '</h3>
                            <h2>' . $car_row['Location'] . '</h2>
                            <a href="sell_car.php?id=' . $car_row['car_id'] . '>Sell</a>
                        ';
                }
            } else {
                echo "<p>No cars owned yet.</p>";
            }

        ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script type="text/javascript" src="js/app.js"></script>
    </body>