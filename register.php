<?php

require_once('connection.php');
if(isset($_POST['regs']))
{
    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $lic=mysqli_real_escape_string($con,$_POST['lic']);
    $ph=mysqli_real_escape_string($con,$_POST['ph']);
   
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
    $cpass=mysqli_real_escape_string($con,$_POST['cpass']);
    $gender=mysqli_real_escape_string($con,$_POST['gender']);
    $Pass=md5($pass);
    if(empty($fname)|| empty($lname)|| empty($email)|| empty($lic)|| empty($ph)|| empty($pass) || empty($gender))
    {
        echo '<script>alert("please fill the place")</script>';
    }
    else{
        if($pass==$cpass){
        $sql2="SELECT *from users where EMAIL='$email'";
        $res=mysqli_query($con,$sql2);
        if(mysqli_num_rows($res)>0){
            echo '<script>alert("EMAIL ALREADY EXISTS PRESS OK FOR LOGIN!!")</script>';
            echo '<script> window.location.href = "index.php";</script>';

        }
        else{
        $sql="insert into users (FNAME,LNAME,EMAIL,LIC_NUM,PHONE_NUMBER,PASSWORD,GENDER) values('$fname','$lname','$email','$lic',$ph,'$Pass','$gender')";
        $result = mysqli_query($con,$sql);
        if($result){
            echo '<script>alert("Registration Successful Press ok to login")</script>';
            echo '<script> window.location.href = "index.php";</script>';       
           }
        else{
            echo '<script>alert("please check the connection")</script>';
        }
    
        }

        }
        else{
            echo '<script>alert("PASSWORD DID NOT MATCH")</script>';
            echo '<script> window.location.href = "register.php";</script>';
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/regs.css" type="text/css">
    <style>
        body {
            background: #fdcd3b;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin: 0;
        }
        .container {
            max-width: 600px;
            width: 100%;
            height: 1005;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .radio-group {
            margin-bottom: 15px;
        }
        .radio-group label {
            margin-right: 15px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #ff7200;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #e65c00;
        }
        #message {
            display: none;
            background: #f1f1f1;
            color: #000;
            padding: 20px;
            border-radius: 4px;
            margin-top: 20px;
        }
        #message p {
            padding: 10px;
            font-size: 18px;
        }
        .valid {
            color: green;
        }
        .valid:before {
            content: "✔";
            margin-right: 10px;
        }
        .invalid {
            color: red;
        }
        .invalid:before {
            content: "✖";
            margin-right: 10px;
        }
        #back {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff7200;
            color: white;
            text-align: center;
            padding: 1px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        #back:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
    <div class="container">
        <a id="back" href="index.php">HOME</a>
        <h1>Register Here</h1>
        <form id="register" action="register.php" method="POST">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" placeholder="Enter Your First Name" required>
            
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" placeholder="Enter Your Last Name" required>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="ex: example@ex.com" placeholder="Enter Valid Email" required>
            
            <label for="lic">Your License Number:</label>
            <input type="text" name="lic" id="lic" placeholder="Enter Your License Number" required>
            
            <label for="ph">Phone Number:</label>
            <input type="tel" name="ph" id="ph" maxlength="10" onkeypress="return onlyNumberKey(event)" placeholder="Enter Your Phone Number" required>
            
            <label for="pass">Password:</label>
            <input type="password" name="pass" id="pass" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            
            <label for="cpass">Confirm Password:</label>
            <input type="password" name="cpass" id="cpass" placeholder="Re-enter the password" required>
            
            <div class="radio-group">
                <label>Gender:</label>
                <label for="male" style="display:flex">
                    Male<input type="radio" id="male" name="gender" value="male">
                </label>
                <label for="female" style="display:flex">
                Female<input type="radio" id="female" name="gender" value="female"> 
                </label>
            </div>
            
            <input type="submit" value="REGISTER" name="regs">
        </form>
        <div id="message">
            <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
    </div>
    <script>
        var myInput = document.getElementById("pass");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");

        myInput.onfocus = function() {
            document.getElementById("message").style.display = "block";
        }

        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        myInput.onkeyup = function() {
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }
        }

        function onlyNumberKey(evt) {
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
            return (ASCIICode >= 48 && ASCIICode <= 57) || ASCIICode === 8;
        }
    </script>
</body>
</html>
