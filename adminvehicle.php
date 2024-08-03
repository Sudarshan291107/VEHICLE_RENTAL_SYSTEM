<?php
    require_once('connection.php');
    $query = "SELECT * FROM cars";
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
        }

        .hai {
            width: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%), url("");
            background-position: center;
            background-size: cover;
            height: 100vh;
        }

        .navbar {
            width: 100%;
            height: 75px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            position: relative;
        }

        .logo {
            color: #ff7200;
            font-size: 35px;
            font-family: Arial;
        }

        .menu {
            display: none; /* Hide menu by default on mobile */
        }

        .menu ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        .menu ul li {
            margin: 0;
            font-size: 14px;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        .hamburger {
            display: none; /* Hide hamburger menu by default on desktop */
            cursor: pointer;
            font-size: 24px;
        }

        .hamburger div {
            width: 30px;
            height: 3px;
            background: #ff7200;
            margin: 6px 0;
            transition: 0.4s;
        }

        .header {
            text-align: center;
            margin: 20px;
            font-size: 30px;
            color: #333;
        }

        .add {
            display: block;
            margin: 20px auto;
            width: 200px;
            height: 40px;
            background: #ff7200;
            border: none;
            font-size: 18px;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            transition: 0.4s ease;
        }

        .add a {
            text-decoration: none;
            color: #fff;
            font-weight: bolder;
        }

        .content-table {
            border-collapse: collapse;
            font-size: 1em;
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            display: table;
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
            margin: 15px auto;
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

        /* Mobile Styles */
        @media (max-width: 768px) {
            .content-table {
                display: none;
            }

            .card {
                display: block;
                width: 90%;
                max-width: 600px;
            }

            .menu {
                display: none;
                position: absolute;
                top: 75px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.9);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                text-align: center;
                padding: 10px 0;
                z-index: 1;
            }

            .menu ul {
                flex-direction: column;
                gap: 10px;
            }

            .hamburger {
                display: block;
            }
        }

        /* Show menu when hamburger is clicked */
        .menu.active {
            display: block;
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
                    <li><button class="add"><a href="index.php">LOGOUT</a></button></li>
                </ul>
            </div>
        </div>

        <h1 class="header">VEHICLE</h1>
        <button class="add"><a href="addcar.php">+ ADD VEHICLE</a></button>

        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>Vehicle ID</th>
                        <th>Vehicle NAME</th>
                        <th>FUEL TYPE</th>
                        <th>CAPACITY</th>
                        <th>PRICE</th>
                        <th>AVAILABLE</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr>
                        <td><?php echo $res['CAR_ID']; ?></td>
                        <td><?php echo $res['CAR_NAME']; ?></td>
                        <td><?php echo $res['FUEL_TYPE']; ?></td>
                        <td><?php echo $res['CAPACITY']; ?></td>
                        <td><?php echo $res['PRICE']; ?></td>
                        <td><?php echo $res['AVAILABLE'] == 'Y' ? 'YES' : 'NO'; ?></td>
                        <td><a href="deletecar.php?id=<?php echo $res['CAR_ID']; ?>">DELETE VEHICLE</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div>
            <?php mysqli_data_seek($queryy, 0); // Reset the result pointer to re-use the data ?>
            <?php while ($res = mysqli_fetch_array($queryy)) { ?>
            <div class="card">
                <h3>Vehicle ID: <?php echo $res['CAR_ID']; ?></h3>
                <p><strong>Vehicle Name:</strong> <?php echo $res['CAR_NAME']; ?></p>
                <p><strong>Fuel Type:</strong> <?php echo $res['FUEL_TYPE']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $res['CAPACITY']; ?></p>
                <p><strong>Price:</strong> <?php echo $res['PRICE']; ?></p>
                <p><strong>Available:</strong> <?php echo $res['AVAILABLE'] == 'Y' ? 'YES' : 'NO'; ?></p>
                <p><a href="deletecar.php?id=<?php echo $res['CAR_ID']; ?>" class="but">DELETE VEHICLE</a></p>
            </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.querySelector('.menu');
            menu.classList.toggle('active');
        }
    </script>
</body>
</html>
