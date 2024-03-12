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
    <?php include 'header.php' ?>
  </body>

</html>
<?php
$insert = false;
if(isset($_POST['id']) ){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password,"DBMS");

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    $id = $_POST['id'];
    $rice = $_POST['rice'];
    $wheat= $_POST['wheat'];
    $sugar= $_POST['sugar'];

    $sql1 ="SELECT * FROM `stock_left` WHERE `id`='$id' ;";
    $result = $con->query($sql1);
    $rows = $result->fetch_assoc();
    if($rows['id']== true){
        // echo "Successfully inserted";
        $sql=" UPDATE `stock_left` SET `rice`=`rice`+'$rice', `wheat`=`wheat`+'$wheat', `sugar`=`sugar`+'$sugar'WHERE `id`='$id'; ";
        // $sql ="INSERT INTO `stock_left` (`id`, `rice`, `wheat`, `sugar`) VALUES ('$id', '$rice', '$wheat', '$sugar');";

        // Flag for successful insertion
      
    }
    else{
        $sql ="INSERT INTO `stock_left` (`id`, `rice`, `wheat`, `sugar`) VALUES ('$id', '$rice', '$wheat', '$sugar');";

    }
    

    

    
    

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
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
    <link rel="stylesheet" href="add_stock.css">
</head>
<body>
    <div class="container">
        <h1>Add Stock</h3>
        <p>Add Stock submit this form </p>
        <?php
        if($insert == true){
        echo "<p class='submitMsg'>Stock Added Successfully</p>";
        $insert = false;
        }
    ?>
        <form action="add_stock.php" method="post">
            <input type="number" name="id" id="id" placeholder="Enter Id">
            <input type="number" name="rice" id="rice" placeholder="Enter Rice (in kg)">
            <input type="number" name="wheat" id="wheat" placeholder="Enter wheat (in kg)">
            <input type="number" name="sugar" id="sugar" placeholder="Enter sugar (in kg)">

    
            <!-- <input type="number" name="contact" id="contact" placeholder="Enter customer number"> -->
    
            <button class="btn">Submit</button> 
        </form>
    </div>
    
    
</body>
</html>
