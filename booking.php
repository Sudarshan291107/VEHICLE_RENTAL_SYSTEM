<?php 

require_once('connection.php');
session_start();

$carid = $_GET['id'];

$sql = "SELECT * FROM cars WHERE CAR_ID='$carid'";
$cname = mysqli_query($con, $sql);

if (!$cname) {
    die('Error: ' . mysqli_error($con));
}

$email = mysqli_fetch_assoc($cname);

if (!$email) {
    die('No car found with this ID.');
}

$value = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE EMAIL='$value'";
$name = mysqli_query($con, $sql);

if (!$name) {
    die('Error: ' . mysqli_error($con));
}

$rows = mysqli_fetch_assoc($name);

if (!$rows) {
    die('No user found with this email.');
}

$uemail = $rows['EMAIL'];
$carprice = $email['PRICE'];

if (isset($_POST['book'])) {
    $bplace = mysqli_real_escape_string($con, $_POST['place']);
    $bdate = date('Y-m-d', strtotime($_POST['date']));
    $dur = mysqli_real_escape_string($con, $_POST['dur']);
    $phno = mysqli_real_escape_string($con, $_POST['ph']);
    $des = mysqli_real_escape_string($con, $_POST['des']);
    $rdate = date('Y-m-d', strtotime($_POST['rdate']));

    if (empty($bplace) || empty($bdate) || empty($dur) || empty($phno) || empty($des) || empty($rdate)) {
        echo '<script>alert("please fill all fields")</script>';
    } else {
        if ($bdate < $rdate) {
            $price = ($dur * $carprice);
            $sql = "INSERT INTO booking (CAR_ID, EMAIL, BOOK_PLACE, BOOK_DATE, DURATION, PHONE_NUMBER, DESTINATION, PRICE, RETURN_DATE) VALUES ($carid, '$uemail', '$bplace', '$bdate', $dur, $phno, '$des', $price, '$rdate')";
            $result = mysqli_query($con, $sql);

            if ($result) {
                $_SESSION['email'] = $uemail;
                header("Location: payment.php");
            } else {
                echo '<script>alert("please check the connection")</script>';
            }
        } else {
            echo '<script>alert("please enter a correct return date")</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VEHICLE BOOKING</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background: url('images/book.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px 20px;
            color: white;
        }
        .logo {
            font-size: 35px;
            color: #ff7200;
        }
        .menu {
            display: none;
        }
        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }
        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-links a {
            text-decoration: none;
            color: white;
            margin: 0 10px;
            font-weight: bold;
            transition: color 0.4s ease-in-out;
        }
        .nav-links a:hover {
            color: orange;
        }
        .profile-info {
            display: flex;
            align-items: center;
        }
        .profile-info img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .profile-info p {
            margin: 0;
        }
        .main {
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .register {
            max-width: 400px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        h2 {
            text-align: center;
            color: #fff;
        }
        label {
            font-size: 18px;
            font-style: italic;
            color: #fff;
        }
        input[type="text"], input[type="number"], input[type="tel"], input[type="date"] {
            width: 100%;
            padding: 10px 0px 10px 0px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
        .btnn {
            width: 100%;
            height: 40px;
            background: #ff7200;
            border: none;
            font-size: 18px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background 0.4s ease;
        }
        .btnn:hover {
            background: #fff;
            color: #ff7200;
        }
        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 20px;
                background-color: rgba(0, 0, 0, 0.9);
                padding: 20px;
                border-radius: 10px;
                width: 200px;
                gap: 10px;
            }

            .nav-links .btnn{
                justify-content: center;
                align-items: center;
                text-align: center;
                display: flex;
            }

            .nav-links.active {
                display: flex;
            }
            .menu-icon {
                display: block;
            }

            .register{

                max-width: 80%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">Apna_Gadi</div>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
        <div class="nav-links">
            <a href="cardetails.php">HOME</a>
            <a href="aboutus2.html">ABOUT</a>
            <a href="contactus2.html">CONTACT</a>
            <a href="index.html" class="btnn">LOGOUT</a>
            <div class="profile-info">
                <img src="images/profile.png" alt="Profile">
                <p>HELLO! <a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="register">
            <h2>BOOKING</h2>
            <form id="register" method="POST">
                <h2>VEHICLE NAME : <?php echo "".$email['CAR_NAME']?></h2>
                <label>BOOKING PLACE:</label>
                <input type="text" name="place" id="name" placeholder="Enter Your Destination">
                <label>BOOKING DATE:</label>
                <input type="date" name="date" id="datefield" placeholder="ENTER THE DATE FOR BOOKING">
                <label>DURATION:</label>
                <input type="number" name="dur" min="1" max="30" id="name" placeholder="Enter Rent Period (in days)">
                <label>PHONE NUMBER:</label>
                <input type="tel" name="ph" maxlength="10" id="name" placeholder="Enter Your Phone Number">
                <label>DESTINATION:</label>
                <input type="text" name="des" id="name" placeholder="Enter Your Destination">
                <label>RETURN DATE:</label>
                <input type="date" name="rdate" id="dfield" placeholder="Enter The Return Date">
                <input type="submit" class="btnn" value="BOOK" name="book">
            </form>
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.querySelector('.nav-links').classList.toggle('active');
        }
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("min", today);
        document.getElementById("dfield").setAttribute("min", today);
    </script>
</body>
</html>





