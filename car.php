<?php include "header.php"; ?>
<?php 
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "abs_cars";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $cid = $_SESSION['id'];
    if(null != $_GET[$cid]) {
        $car = "SELECT * FROM cars WHERE id='1'";
        $car_run = mysqli_query($conn, $car);

        echo "found some thing in the database";
    } else {
        echo "0 results";
    }
?>