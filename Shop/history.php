<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8" />

  <meta name="viewport"
    content="width=device-width, initial-scale=1.0" />

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="history.css" />

  <title>Home</title>
  <style>

    #information {
      color: black;
      background-color: #E4F5D4;
      text-align: center;
      /* margin-bottom: 57px; */
      height: 25px;
      padding: 20px;
      position :fixed;
      bottom:0px;

    }
  </style>

</head>

<body>

<?php include 'header.php' ?>
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
    $sql = " SELECT * FROM `history` ; ";
    // $sql1="SELECT * FROM `sell_date` ;";

    $result = $mysqli->query($sql);
    // $result1 = $mysqli->query($sql1);
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
        table {
          margin: 5% auto;
          font-size: large;
          border: 1px solid black;
          width: 40em;
        }

        h1 {
          text-align: center;
          color: #006600;
          font-size: xx-large;
          font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }

        td {
          background-color: #E4F5D4;
          border: 1px solid black;
        }

        th,
        td {
          font-weight: bold;
          border: 1px solid black;
          padding: 10px;
          text-align: center;
        }

        td {
          font-weight: lighter;
        }
      </style>
    </head>

    <body>
      <section>

        <table>
          <!-- <h1>Customer info</h1> -->
          <caption>
            <h1>History</h1>
          </caption>
          <tr>
          <th>id</th>
           <th>date</th>

            <th>rice(in kg)</th>
            <th>wheat(in kg)</th>
            <th>sugar(in kg)</th>
            <!-- <th>income</th> -->
                
               
          </tr>
          <?php
          while ($rows = $result->fetch_assoc()  ) {
          ?>
          <tr>
            <td>
              <?php echo $rows['id']; ?>
            </td>
            <td>
              <?php echo $rows['date']; ?>
            </td>
            <td>
              <?php echo $rows['rice']; ?>
            </td>
            <td><?php echo $rows['wheat']; ?></td>
            <td><?php echo $rows['sugar']; ?></td>
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
  <div id="information">
   
  </div>
</body>

</html>