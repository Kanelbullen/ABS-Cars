<!DOCTYPE html>
<body>
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

        $sql = "SELECT * FROM cars";
        $result = $conn->query($sql);
    ?>

    <div class="services" id="services">
        <h1>Our Cars</h1>
        <?php 
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $car = '
                        <div class="services__wrapper">
                            <div class="services__card">
                                <img src="' .$row['image']. '" alt="Car" class="services__img">
                                <h1>' .$row['name']. '</h1>
                                <h2>' .$row['price']. 'kr' .'</h2>
                                <h3>' .$row['description']. '</h3>
                                <h2>' .$row['Location']. '</h2>
                            <div class="services__btn"><a href="car.php?id='.$row['id'].'">Köp</a></div>
                        </div>
                    ';
                    echo $car;
                }
            } else {
                echo "0 results";
            }
        ?>
    </div>

</body>
<?php   $conn->close(); ?>
<script type="text/javascript" src="js\script.js"></script>