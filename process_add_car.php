<?php
session_start();
include "header.php";

$server = "localhost";
$username = "root";
$password = "";
$database = "abs_cars";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $sql = "INSERT INTO cars (name, price, description, Location, image) VALUES ('$name', '$price', '$description', '$location', '$image')";

    if (mysqli_query($conn, $sql)) {
        echo "Car added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>