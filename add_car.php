<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
</head>
<body>

<?php include "header.php"; ?>

<div class="container">
    <h1>Add a New Car</h1>
    <form action="process_add_car.php" method="post">
        <label for="name">Car Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="price">Price (kr):</label>
        <input type="number" id="price" name="price" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" required>

        <input type="submit" value="Add Car">
    </form>
</div>

</body>
</html>
