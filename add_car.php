<?php include "header.php"; ?>

<nav class="form">
    <div class="form">
        <center>
            <h1>Add a New Car</h1>
            <form class="login_form" action="process_add_car.php" method="post">
                <div class="font">Car Name</div>
                <input type="text" id="name" name="name" required>

                <div class="font">Price:</div>
                <input type="number" id="price" name="price" required>

                <div class="font">Description</div>
                <textarea id="description" name="description" required></textarea>

                <div class="font">Location:</div>
                <input type="text" id="location" name="location" required>

                <div class="font">Image URL:</div>
                <input type="text" id="image" name="image" required>
                <br>
                <br>
                <input type="submit" value="Add Car">
            </form>
        </center>
    </div>
</nav>

</body>
</html>
