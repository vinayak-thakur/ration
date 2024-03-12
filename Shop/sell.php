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
    // echo "Success connecidting to the db";

    // Collect post variables
    $id = $_POST['id'];
    // $name = $_POST['name'];
    // $family_count = $_POST['family_count'];
    $rice = $_POST['rice'];
    $wheat = $_POST['wheat'];
    $sugar= $_POST['sugar'];


    // $rows2 = $result->fetch_assoc();
    // // echo $rows2['rice'];

    $sql3 ="SELECT * FROM `stock_left` WHERE `id`='$id' ;";
    $result5 = $con->query($sql3);
    $rows5 = $result5->fetch_assoc();
    if($rows5['rice']-$rice>=0 && $rows5['wheat']-$wheat>=0  && $rows5['sugar']-$sugar>=0 ){
      $sql=" UPDATE `stock_left` SET `rice`=`rice`-'$rice', `wheat`=`wheat`-'$wheat', `sugar`=`sugar`-'$sugar'WHERE `id`='$id'; ";
      // Execute the query
      $sql1="INSERT INTO `history` (`id`,`date`,`rice`, `wheat`, `sugar`) VALUES ('$id',current_timestamp(),  '$rice', '$wheat', '$sugar');";
      $con->query($sql1);


        if($con->query($sql) == true){
          // echo "Successfully inserted";

          // Flag for successful insertion
          $insert = true;
        }
        else{
            echo "ERROR: $sql <br> $con->error";
        }
    }
    else{
      $insert1 = true;
    
  

    }
    
  
    // $sql=" UPDATE `stock_left` SET `rice`=`rice`-'$rice', `wheat`=`wheat`-'$wheat', `sugar`=`sugar`-'$sugar'WHERE `id`='$id'; ";
    // // Execute the query
    // $sql1="INSERT INTO `history` (`id`,`date`,`rice`, `wheat`, `sugar`) VALUES ('$id',current_timestamp(),  '$rice', '$wheat', '$sugar');";
  
    // if($con->query($sql) == true){
    //     // echo "Successfully inserted";

    //     // Flag for successful insertion
    //     $insert = true;
    // }
    // else{
    //     echo "ERROR: $sql <br> $con->error";
    // }
  
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
    <style>
      #information {
    color: black;
    background-color: #E4F5D4;
    text-align: center;
    /* margin-bottom: 57px; */
    /* height: 25px; */
    padding: 20px;
    position :fixed;
    bottom:0px;

  }

    </style>
</head>
<body>
    <div class="container">
        <h1>sell grain</h3>
        <p>Enter id correctly </p>
        <?php
        if($insert == true){
    
          echo "<p class='submitMsg'>  Data Updated Succesfully!!!</p>";
          // echo "the  invoice amount : "+"$bill_amount";
        }
        if($insert1 == true){
    
          echo "<p class='submitMsg'>  Enter Correct Details</p>";
        }
    ?>
        <form action="" method="post">
            <input type="number" name="id" id="id" placeholder="Enter Id">
            <input type="number" name="rice" id="rice" placeholder="rice in kg">
            <input type="number" name="wheat" id="wheat" placeholder="wheat in kg">
            <input type="number" name="sugar" id="sugar" placeholder="sugar in kg">
            <button class="btn">Submit</button> 
        </form>
    </div>
    <div id="information">
		Selling grains
	</div>
    
</body>
</html>
