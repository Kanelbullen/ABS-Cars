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
?>
    <div class="services" id="services">
<?php
    if (isset($_GET['id'])) {
        $car_id = $_GET['id'];
        $car_query = "SELECT * FROM cars WHERE id='$car_id'";
        $car_result = mysqli_query($conn, $car_query);

        if (mysqli_num_rows($car_result) > 0) {
            // output data of the selected car
            $row = mysqli_fetch_assoc($car_result);
            echo '
                <div class="services__wrapper">
                    <div class="services__card">
                        <img src="' . $row['image'] . '" alt="Car" class="services__img">
                        <h1>' . $row['name'] . '</h1>
                        <h2>' . $row['price'] . 'kr' . '</h2>
                        <h3>' . $row['description'] . '</h3>
                        <h2>' . $row['Location'] . '</h2>
                        <div class="services__btn"><a href="buy_car.php?id='.$row['id'].'">Köp</a></div>
                    </div>
                </div>
                ';
        } else {
            echo "Car not found in the database";
        }
    } else {
        echo "Car ID not provided in the URL";
    }

    $conn->close();
?>
</div>