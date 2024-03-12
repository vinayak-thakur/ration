<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location: index.php"); // Redirect to login page if not logged in
    exit();
}
?>


<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport"
    content="width=device-width, initial-scale=1.0" />

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="adminpage.css" />

  <title>Home</title>
  <style>
    /* Resetting default styles */
body, h1, h2, h3, p, ul, ol, li, table, th, td {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Montserrat', sans-serif;
  background-color: #f0f0f0;
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.section {
  width: 80%;
  max-width: 800px; /* Adjust as needed */
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.section h1 {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

.table-container {
  margin-top: 20px;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th,
table td {
  padding: 10px;
  text-align: center;
  border-bottom: 1px solid #ccc;
}

  </style>

</head>

<body>

<?php include 'header.php'; ?>
  <!-- <div class="body-text"><h1>This is Home Page!</h1></div> -->
  <div class="a">
    <!-- SELECT sum(rice) as rice,sum(wheat)as wheat,sum(sugar)as sugar FROM `stock_left`;  -->
    <?php

    // Username is root
    $user = 'root';
    $password = '';

    // Database name is geeksforgeeks
    $database = 'DBMS';

    // Server is localhost with
// port number 3306
    $servername = 'localhost:3306';
    $mysqli = new mysqli($servername, $user,
      $password, $database);

    // Checking for connections
    if ($mysqli->connect_error) {
      die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
    }

    // SQL query to select data from database
    $sql = " SELECT sum(rice) as 'rice',sum(wheat)as 'wheat',sum(sugar)as 'sugar' FROM `stock_left`; ";
    $result = $mysqli->query($sql);
    $sql1="SELECT * FROM `price` ";
    $result1 = $mysqli->query($sql1);

    $mysqli->close();
    ?>
    <!-- HTML code to display data in tabular format -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>User Details</title>
      <!-- CSS FOR STYLING THE PAGE -->
      <style>
        /* Resetting default styles */
body, h1, h2, h3, p, ul, ol, li, table, th, td {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Montserrat', sans-serif;
}

.container {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 20px;
}

section {
  margin: auto;
  width: 48%;
  margin-top: 5em;
  padding-top: 5em;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
section  *{
  padding: .5rem;
}

.section h1 {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
}

.table-container {
  margin-top: 20px;
  overflow-x: auto;
}

table {
  width: 100%;
  border-collapse: collapse;
}

table th,
table td {
  padding: 10px;
  text-align: center;
  border-bottom: 1px solid #ccc;
}

.table-container:first-child {
  margin-right: 20px;
}

.table-container:last-child {
  margin-left: 20px;
}

@media screen and (max-width: 768px) {
  .container {
    flex-direction: column;
    align-items: center;
  }
  
  .section {
    width: 100%;
    margin-bottom: 20px;
  }
}

      </style>
    </head>

    <body>
      <section>

        <table>
          <!-- <h1>Customer info</h1> -->
          <caption>
            <h1>Available Stock</h1>
          </caption>
          <tr>

            <th>rice(in kg)</th>
            <th>wheat(in kg)</th>
            <th>sugar(in kg)</th>
            <!-- <th>income</th>
                <th>contact</th>
                <th>city</th> -->
          </tr>
          <?php
          while ($rows = $result->fetch_assoc()) {
          ?>
          <tr>
            <td>
              <?php echo $rows['rice']; ?>
            </td>
            <td>
              <?php echo $rows['wheat']; ?>
            </td>
            <td>
              <?php echo $rows['sugar']; ?>
            </td>
            <!-- <td><?php echo $rows['income']; ?></td> -->
            <!-- <td><?php echo $rows['contact']; ?></td> -->
            <!-- <td><?php echo $rows['city']; ?></td> -->
          </tr>
          <?php
          }
          ?>
        </table>

        <table>
          <!-- <h1>Customer info</h1> -->
          <caption>
            <h1>price</h1>
          </caption>
          <tr>
          <th>color</th>

            <th>rice(in rupees/kg)</th>
            <th>wheat(in rupees/kg)</th>
            <th>sugar(in rupees/kg)</th>
            <!-- <th>income</th>
                <th>contact</th>
                <th>city</th> -->
          </tr>
          <?php
          while ($rows = $result1->fetch_assoc()) {
          ?>
          <tr>
            <td>
              <?php echo $rows['color']; ?>
            </td>
            <td>
              <?php echo $rows['rice']; ?>
            </td>
            <td>
              <?php echo $rows['wheat']; ?>
            </td>
            <td>
              <?php echo $rows['sugar']; ?>
            </td>
            <!-- <td><?php echo $rows['id']; ?></td> -->
            <!-- <td><?php echo $rows['contact']; ?></td> -->
            <!-- <td><?php echo $rows['city']; ?></td> -->
          </tr>
          <?php
          }
          ?>
        </table>
      </section>

    </body>

    </html>



  </div>
  <div class="c"></div>
</body>

</html>