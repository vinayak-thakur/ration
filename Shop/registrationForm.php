<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="registration.php" name = "registrationForm" method = "POST">
            <input type="number" name="id" id="id" placeholder="Enter id">
            <input type="text" name="name" id="name" placeholder="Enter customer name">
            <!-- <input type="text" name="color" id="color" placeholder="Enter customer card-color"> -->
            <input type="number" name="income" id="id" placeholder="Enter customer income">
            <input type="number" name="family_count" id="family_count" placeholder="Enter customer family count">
            <!-- <input type="number" name="contact" id="contact" placeholder="Enter customer number"> -->
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Enter custommer telephone number">
            <input type="text" name="city" id="city" placeholder="Enter customer city">
            <button class="btn">Submit</button> 
    </form>
</body>
</html>