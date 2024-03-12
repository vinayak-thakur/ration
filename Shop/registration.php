<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link

      href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"

      rel="stylesheet"

    />

    <link rel="stylesheet" href="adminpage.css" />

    <title>Home</title>

  </head>

  <body>
  <?php include 'header.php'; ?>
  </body>

</html>
<?php
$insert = false;
$insert1 = false;
if(isset($_POST['id']) ){
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password,"DBMS");
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }

    $id = $_POST['id'];
    $name = $_POST['name'];
    $income = $_POST['income'];



    if ($income<= 30000) {
      $color="yellow";
    } elseif ($income<= 100000) {
      $color="orange";
    } else {
      $color="white";
    }
    $family_count=$_POST['family_count'];
    $contact = $_POST['phone'];
    $city= $_POST['city'];

  









    $sql1 ="SELECT * FROM `customer_details` WHERE `id`='$id' ;";
    $result = $con->query($sql1);
    $rows = $result->fetch_assoc();
    if($rows['id']== true){

    $insert1 = true;

    }
    else{
      $sql ="INSERT INTO `customer_details` (`id`, `name`, `color`, `family_count`, `contact`, `city`) VALUES('$id', '$name', '$color', '$family_count','$contact', '$city');";

      if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
      }
      else{
          echo "ERROR: $sql <br> $con->error";
      }
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration  form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="container">
        <h1>Registration form</h3>
        <p>Enter customer details and submit this form </p>
        <?php
        if($insert == true){
        echo "<p class='submitMsg'>Registration completed!!!!</p>";
        }
        if($insert1 == true){
          echo "<p class='submitMsg'>Data Already exits for that Id!!!</p>";
          }
  
    ?>
        <form action="registration.php" method="post">
            <input type="number" name="id" id="id" placeholder="Enter Id">
            <input type="text" name="name" id="name" placeholder="Enter customer name">
            <!-- <input type="text" name="color" id="color" placeholder="Enter customer card-color"> -->
            <input type="number" name="income" id="id" placeholder="Enter customer income">
            <input type="number" name="family_count" id="family_count" placeholder="Enter customer family count">
            <!-- <input type="number" name="contact" id="contact" placeholder="Enter customer number"> -->
            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Enter custommer telephone number">
            <input type="text" name="city" id="city" placeholder="Enter customer city">
            <button class="btn">Submit</button> 
        </form>
    </div>
    
    
</body>
</html>
