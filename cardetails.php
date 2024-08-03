<?php
// Start the session at the very beginning
session_start();

// Include your connection file
require_once('connection.php');

// Check if the email is set in the session
if (isset($_SESSION['email'])) {
    $value = $_SESSION['email'];

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE EMAIL='$value'";
    $name = mysqli_query($con, $sql);
    $rows = mysqli_fetch_assoc($name);

    // Fetch available cars from the database
    $sql2 = "SELECT * FROM cars WHERE AVAILABLE='Y'";
    $cars = mysqli_query($con, $sql2);
} else {
    // Handle the case where session email is not set
    echo "Session email is not set.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url("images/carbg2.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: black;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo {
            color: #ff7200;
            font-size: 24px;
        }

        .menu {
            display: flex;
            align-items: center;
        }

        .menu ul {
            display: flex;
            list-style: none;
            gap: 20px;
            color: white;
        }

        .menu ul li {
            font-size: 14px;
            color: white;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.4s ease;
            color: white;
        }

        .menu ul li a:hover {
            color: orange;
        }

        .menu button {
            background: #ff7200;
            border: none;
            color: white;
            font-size: 14px;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
            transition: background 0.4s ease;
        }

        .menu button a {
            text-decoration: none;
            color: white;
        }

        .menu button:hover {
            background: #e65c00;
        }

        .circle {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        .phello {
            margin-left: 10px;
        }

        .overview {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: white;
        }

        .de {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .box {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 300px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .box .imgBx {
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .box .imgBx img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .box .content {
            padding: 15px;
        }

        .box .content h1 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .box .content h2 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .box .utton {
            background: #ff7200;
            border: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.4s ease;
            text-align: center;
        }

        .box .utton:hover {
            background: #e65c00;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .menu ul {
                flex-direction: column;
                gap: 10px;
                display: none;
                margin-top: 20px;
            }

            .menu .hamburger {
                display: block;
                cursor: pointer;
                font-size: 24px;
                background: none;
                border: none;
                color: #ff7200;
                margin-left: auto;
            }

            .menu ul.show {
                display: flex;
            }

            .box {
                width: 100%;
                margin: 10px;
            }
        }
    </style>
</head>

<body class="body">

    <div class="navbar">
        <div style="display:flex;">
        <h2 class="logo">Apna_Gadi</h2>
        <button class="hamburger" style="position:absolute;right:20px;">&#9776;</button>
        </div>
        <div class="menu">
            <ul>
                <li><a href="contactus2.html">CONTACT</a></li>
                <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                <li><button><a href="index.php">LOGOUT</a></button></li>
                <li><img src="images/profile.png" class="circle" alt="Profile Picture"></li>
                <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p></li>
                <li><a id="stat" href="bookinstatus.php">BOOKING STATUS</a></li>
            </ul>
        </div>
    </div>

    <h1 class="overview">OUR VEHICLES OVERVIEW</h1>

    <div class="de">
        <?php while($result = mysqli_fetch_array($cars)) { ?>    
            <div class="box">
                <div class="imgBx">
                    <img src="images/<?php echo $result['CAR_IMG']?>" alt="Vehicle Image">
                </div>
                <div class="content">
                    <h1><?php echo $result['CAR_NAME']?></h1>
                    <h2>Fuel Type: <a><?php echo $result['FUEL_TYPE']?></a></h2>
                    <h2>CAPACITY: <a><?php echo $result['CAPACITY']?></a></h2>
                    <h2>Rent Per Day: <a>₹<?php echo $result['PRICE']?>/-</a></h2>
                    <button class="utton"><a href="booking.php?id=<?php echo $result['CAR_ID']?>">BOOK</a></button>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            document.querySelector('.menu ul').classList.toggle('show');
        });
    </script>
</body>
</html>
