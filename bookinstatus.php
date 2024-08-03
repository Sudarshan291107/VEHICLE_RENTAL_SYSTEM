<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        background: url("images/carbg2.jpg") center/cover no-repeat;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .box {
        background: linear-gradient(to top, rgba(255, 251, 251, 1)70%, rgba(250, 246, 246, 1)90%);
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
        padding: 20px;
        width: 90%;
        max-width: 700px;
        box-sizing: border-box;
      }

      .content {
        font-size: larger;
        margin-bottom: 20px;
      }

      .button, .utton {
        display: block;
        width: 100%;
        max-width: 240px;
        height: 40px;
        background: #ff7200;
        border: none;
        margin: 10px auto;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        color: #fff;
        transition: 0.4s ease;
        text-align: center;
      }

      .utton {
        max-width: 200px;
      }

      .utton a, .button a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        display: block;
        height: 100%;
        line-height: 40px;
        text-align: center;
      }

      .button:hover, .utton:hover {
        background: #fff;
        color: #ff7200;
      }

      ul {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
      }

      ul li {
        list-style: none;
        font-size: 20px;
        margin-bottom: 10px;
      }

      .name {
        font-weight: bold;
      }

      @media (min-width: 600px) {
        ul {
          flex-direction: row;
          justify-content: center;
        }

        ul li {
          margin: 0 20px;
          font-size: 25px;
        }
      }
    </style>
</head>
<body>

<?php
    require_once('connection.php');
    session_start();
    $email = $_SESSION['email'];

    $sql = "select * from booking where EMAIL='$email' order by BOOK_ID DESC LIMIT 1";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);
    if ($rows == null) {
        echo '<script>alert("THERE ARE NO BOOKING DETAILS")</script>';
        echo '<script> window.location.href = "cardetails.php";</script>';
    } else {
        $sql2 = "select * from users where EMAIL='$email'";
        $name2 = mysqli_query($con, $sql2);
        $rows2 = mysqli_fetch_assoc($name2);
        $car_id = $rows['CAR_ID'];
        $sql3 = "select * from cars where CAR_ID='$car_id'";
        $name3 = mysqli_query($con, $sql3);
        $rows3 = mysqli_fetch_assoc($name3);
?>

   <ul>
     <li><button class="utton"><a href="cardetails.php">Go to Home</a></button></li>
     <li class="name">HELLO! <?php echo $rows2['FNAME']." ".$rows2['LNAME']?></li>
   </ul>
    <div class="box">
         <div class="content">
             <h1>VEHICLE NAME : <?php echo $rows3['CAR_NAME']?></h1><br>
             <h1>NO OF DAYS : <?php echo $rows['DURATION']?></h1><br>
             <h1>BOOKING STATUS : <?php echo $rows['BOOK_STATUS']?></h1><br>
         </div>
     </div>

<?php } ?>

</body>
</html>
