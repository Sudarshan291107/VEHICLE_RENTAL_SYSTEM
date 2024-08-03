<?php
        require_once('connection.php');
        if(isset($_POST['adlog'])){
            $id = $_POST['adid'];
            $pass = $_POST['adpass'];
            
            if(empty($id) || empty($pass)) {
                echo '<script>alert("Please fill in all fields")</script>';
            } else {
                $query = "SELECT * FROM admin WHERE ADMIN_ID='$id'";
                $res = mysqli_query($con, $query);
                if($row = mysqli_fetch_assoc($res)){
                    $db_password = $row['ADMIN_PASSWORD'];
                    if($pass == $db_password) {
                        echo '<script>alert("Welcome ADMINISTRATOR!");</script>';
                        header("Location: admindash.php");
                    } else {
                        echo '<script>alert("Incorrect password")</script>';
                    }
                } else {
                    echo '<script>alert("Invalid admin ID")</script>';
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
    <title>ADMIN LOGIN</title>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward(); 
        }
          
        setTimeout("preventBack()", 0);
          
        window.onunload = function () { null };
    </script>
    <style>
        body {
            width: 100%;
            background-image: url("images/adminbg2.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .form {
            width: 300px;
            height: 400px;
            background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
        }

        .form h2 {
            width: 100%;
            font-family: sans-serif;
            text-align: center;
            color: orange;
            font-size: 22px;
            background-color: white;
            border-radius: 10px;
            margin: 2px;
            padding: 10px 0px 10px 0px;
        }

        .h {
            width: 100%;
            height: 40px;
            background: transparent;
            border-bottom: 1px solid #ff7200;
            border-top: none;
            border-right: none;
            border-left: none;
            color: #fff;
            font-size: 15px;
            letter-spacing: 1px;
            margin-top: 20px;
            font-family: sans-serif;
        }

        .h:focus {
            outline: none;
        }

        ::placeholder {
            color: #fff;
            font-family: Arial;
        }

        .btnn {
            width: 100%;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
        }

        .btnn:hover {
            background: #fff;
            color: #ff7200;
        }

        .btnn a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .form .link {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 17px;
            padding-top: 20px;
            text-align: center;
            color: #fff;
        }

        .form .link a {
            text-decoration: none;
            color: #ff7200;
        }

        .helloadmin {
            width: 100%;
            height: auto;
            margin-top: 20px;
            text-align: center;
        }

        .helloadmin h1 {
            margin-top: 0;
            font-family: 'Times New Roman';
            font-size: 30px;
            color: white;
        }

        .back {
            width: auto;
            height: 40px;
            background: #ff7200;
            border: none;
            margin: 20px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
        }

        .back a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        /* Media Query for Mobile Devices */
        @media (max-width: 600px) {
            .form {
                width: 90%;
                height: auto;
                top: 10%;
                left: 5%;
                transform: none;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin: auto;
                top: 30%;
            }

            .form h2 {
                font-size: 18px;
                padding: 10px 0px 10px 0px ;
            }

            .h {
                height: 35px;
                font-size: 14px;
            }

            .btnn {
                font-size: 16px;
            }

            .helloadmin h1 {
                font-size: 24px;
            }

            .back {
                width: 90%;
                font-size: 16px;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>


    <button class="back"><a href="index.php">Go To Home</a></button>
    <div class="helloadmin">
        <h1>HELLO ADMIN!</h1>
    </div>

    <form class="form" method="POST">
        <h2>Admin Login</h2>
        <input class="h" type="text" name="adid" placeholder="Enter admin user id">
        <input class="h" type="password" name="adpass" placeholder="Enter admin password">
        <input type="submit" class="btnn" value="LOGIN" name="adlog">
    </form>
</body>
</html>
