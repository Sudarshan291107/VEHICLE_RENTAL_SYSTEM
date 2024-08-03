<?php
        require_once('connection.php');
        $query = "SELECT * FROM feedback";
        $queryy = mysqli_query($con, $query);
    ?>

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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .hai {
            width: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%), url("");
            background-position: center;
            background-size: cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .logo {
            color: #ff7200;
            font-size: 35px;
            font-family: Arial, sans-serif;
        }

        .menu {
            display: flex;
        }

        .menu ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }

        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: black;
            margin: 5px 0;
            transition: 0.3s;
        }

        .header {
            text-align: center;
            margin-top: 20px;
            font-size: 30px;
            color: #333;
        }

        .content-table {
            border-collapse: collapse;
            font-size: 0.9em;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            margin: 25px auto;
            width: 90%;
            max-width: 1200px;
            background: #fff;
        }

        .content-table thead tr {
            background-color: orange;
            color: white;
            text-align: left;
        }

        .content-table th, .content-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid orange;
        }

        .card {
            display: none;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .card p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }

        .nn {
            background: #ff7200;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.4s ease;
            font-size: 16px;
        }

        .nn a {
            text-decoration: none;
            color: white;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .menu {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .hamburger.active div {
                background-color: orange;
            }

            .menu.active {
                display: flex;
                flex-direction: column;
                width: 100%;
                background: rgba(255, 255, 255, 0.9);
                position: absolute;
                top: 75px;
                left: 0;
                z-index: 1000;
            }

            .menu.active ul {
                flex-direction: column;
                padding: 10px;
            }

            .menu.active ul li {
                margin: 10px 0;
            }

            .content-table {
                display: none;
            }

            .card {
                display: block;
                width: 90%;
                max-width: 600px;
                margin: 20px auto;
            }
        }
    </style>
</head>
<body>

    <div class="hai">
        <div class="navbar">
            <div class="logo">Apna_Gadi</div>
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                    <li><a href="adminusers.php">USERS</a></li>
                    <li><a href="admindash.php">FEEDBACKS</a></li>
                    <li><a href="adminbook.php">BOOKING REQUEST</a></li>
                    <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                </ul>
            </div>
        </div>
        <div>
            <h1 class="header">FEEDBACKS</h1>
            <div class="content-table">
                <thead>
                    <tr>
                        <th>FEEDBACK_ID</th> 
                        <th>EMAIL</th>
                        <th>COMMENT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_array($queryy)) { ?>
                        <tr>
                            <td><?php echo $res['FED_ID']; ?></td>
                            <td><?php echo $res['EMAIL']; ?></td>
                            <td><?php echo $res['COMMENT']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </div>

            <!-- Mobile Card View -->
            <div class="content-card">
                <?php mysqli_data_seek($queryy, 0); // Reset the result pointer to re-use the data ?>
                <?php while ($res = mysqli_fetch_array($queryy)) { ?>
                    <div class="card">
                        <h3>Feedback ID: <?php echo $res['FED_ID']; ?></h3>
                        <p><strong>Email:</strong> <?php echo $res['EMAIL']; ?></p>
                        <p><strong>Comment:</strong> <?php echo $res['COMMENT']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            const hamburger = document.querySelector('.hamburger');
            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
        }
    </script>
</body>
</html>
