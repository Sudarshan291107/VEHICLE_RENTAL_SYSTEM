<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="Stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('Home%20page%20pics/background1.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        .btn-home {
            width: 150px;
            background: orange;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 18px;
            margin-left: 100px;
            margin-top: 25px;
            text-align: center;
        }
        .btn-home a {
            text-decoration: none;
            color: #fff;
        }
        .contact-us {
            font-size: 50px;
            color: #000;
        }
        .contact-us strong {
            font-size: 5cm;
            color: #555;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .feedback-form {
            width: 100%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-control {
            margin-bottom: 15px;
        }
        .form-control textarea {
            resize: vertical;
        }
        .submit-btn {
            background: #17a2b8;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px;
            font-size: 24px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    require_once('../connection.php');
    session_start();
    $email = $_SESSION['email'];

    if(isset($_POST['submit'])){
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $sql = "INSERT INTO feedback (EMAIL, COMMENT) VALUES ('$email', '$comment')";
        $result = mysqli_query($con, $sql);
        echo '<script>alert("Feedback Sent Successfully!! THANK YOU!!")</script>';
        header("Location: ../cardetails.php");
    }
    ?>

    <button class="btn-home">
        <a href="../cardetails.php">Go To Home</a>
    </button>

    <div class="form-container">
        <h2 class="contact-us"><strong>F</strong>eedback.</h2>
        <div class="feedback-form">
            <form method="POST">
                <div class="form-group">
                    <label for="name"><h4>Name:</h4></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="User name" required>
                </div>
                <div class="form-group">
                    <label for="email"><h4>Email:</h4></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="User Email" required>
                </div>
                <div class="form-group">
                    <label for="comment"><h4>Comments:</h4></label>
                    <textarea id="comment" name="comment" class="form-control" rows="6" placeholder="Message" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="submit-btn" value="SUBMIT" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
