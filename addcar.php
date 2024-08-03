<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-image: url("../images/regs.jpg");
            background-size: cover;
            background-position: center;
            font-family: sans-serif;
            height: 57rem;
        }
        .main {
            max-width: 95%;
            margin: 0 auto;
            padding: 20px;
        }
        .btnn {
            width: 100%;
            max-width: 240px;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 30px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            transition: 0.4s ease;
            text-align: center;
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
        h2 {
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .register {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 600px;
            font-size: 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
            color: #fff;
            margin: auto;
            padding: 20px;
            height: 45rem;
        }
        form#register {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-size: 18px;
            font-style: italic;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            height: auto;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 10px;
            background-color: #fff;
            box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
        }
        input[type="file"] {
            cursor: pointer;
        }
        #back {
            display: block;
            width: 100%;
            max-width: 100px;
            height: 40px;
            background: #ff7200;
            border: none;
            margin-top: 10px;
            font-size: 18px;
            margin: 10px auto;
        }
        #back a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            display: block;
            height: 100%;
            line-height: 40px;
            text-align: center;
        }
        @media (max-width: 600px) {
            .btnn {
                font-size: 16px;
            }
            h2 {
                font-size: 20px;
            }
            .register {
                padding: 15px;
            }
            input[type="text"],
            input[type="number"] {
                padding: 8px;
            }
            #back {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <button id="back"><a href="adminvehicle.php">HOME</a></button> 
    
    <div class="main">
        <div class="register">
            <h2>Enter Details Of New Vehicle</h2>
            <form id="register" action="upload.php" method="POST" enctype="multipart/form-data" onsubmit="console.log('Form submitted');">    
                <label for="carname">Vehicle Name:</label>
                <input type="text" name="carname" id="carname" placeholder="Enter Vehicle Name" required>

                <label for="ftype">Fuel Type:</label>
                <input type="text" name="ftype" id="ftype" placeholder="Enter Fuel Type" required>

                <label for="capacity">Capacity:</label>
                <input type="number" name="capacity" id="capacity" min="1" placeholder="Enter Capacity Of the Vehicle" required>
                
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" min="1" placeholder="Enter Price Of Vehicle for One Day (in rupees)" required>

                <label for="image">Vehicle Image:</label>
                <input type="file" name="image" id="image" required>

                <input type="submit" class="btnn" value="ADD Vehicle" name="addcar">
            </form>
        </div>
    </div>
</body>
</html>
