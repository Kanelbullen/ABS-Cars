<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $car_id = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "abs_cars";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user ID from session
    $user_id = $_SESSION['id'];

    // delete from user_cars table
    $delete_query = "DELETE FROM user_cars WHERE user_id = '$user_id' AND car_id = '$car_id'";
    if (mysqli_query($conn, $delete_query)) {
        // update for_sale status in cars table
        $update_query = "UPDATE cars SET for_sale = 1 WHERE id = '$car_id'";
        if (mysqli_query($conn, $update_query)) {
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating car status: " . mysqli_error($conn);
        }
    } else {
        echo "Error removing car from user's ownership: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    header("Location: profile.php");
    exit();
}
?>
