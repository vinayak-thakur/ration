<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Order Form</title>
    <link rel="stylesheet" href="bookOrder.css"> <!-- You can add your own CSS file if needed -->
</head>
<body>
    <h2>Book Order Form</h2>
    <form action="processOrder.php" method="post">
        <label for="rice">Rice (in kg): </label>
        <input type="number" name="rice" id="rice" required>

        <label for="wheat">Wheat (in kg): </label>
        <input type="number" name="wheat" id="wheat" required>

        <label for="sugar">Sugar (in kg): </label>
        <input type="number" name="sugar" id="sugar" required>

        <button type="submit">Place Order</button>
    </form>
</body>
</html>
