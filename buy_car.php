<?php
session_start();

if (isset($_GET['id']) && isset($_SESSION['id'])) {
    // Retrieve car ID from URL parameter
    $car_id = $_GET['id'];
    
    // Retrieve user ID from session
    $user_id = $_SESSION['id'];
    
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "abs_cars";
    
    $conn = mysqli_connect($servername, $username, $password, $database);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Check if the car is already owned by another user
    $check_query = "SELECT * FROM user_cars WHERE car_id = '$car_id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Car is already owned by another user
        echo "<script>alert('This car has already been sold.'); window.location.href = 'index.php';</script>";
    } else {
        $insert_query = "INSERT INTO user_cars (user_id, car_id) VALUES ('$user_id', '$car_id')";
        if (mysqli_query($conn, $insert_query)) {
            $update_query = "UPDATE cars SET for_sale = 0 WHERE id = '$car_id'";
            if (mysqli_query($conn, $update_query)) {
                // Success message for purchase
                echo "<script>alert('Car purchased successfully!'); window.location.href = 'index.php';</script>";
            } else {
                // Error message for updating car status
                echo "<script>alert('Error updating car status: " . mysqli_error($conn) . "'); window.location.href = 'index.php';</script>";
            }
        } else {
            // Error message for purchasing car
            echo "<script>alert('Error purchasing car: " . mysqli_error($conn) . "'); window.location.href = 'index.php';</script>";
        }
    }
    
    mysqli_close($conn);
} else {
    // Error message for missing car ID or user not logged in
    echo "<script>alert('Car ID not provided in the URL or user not logged in.'); window.location.href = 'index.php';</script>";
}
?>
