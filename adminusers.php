<?php
    require_once('connection.php');
    $query = "SELECT * FROM users";
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

        .hai {
            width: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0)50%, rgba(0,0,0,0)50%), url("");
            background-position: center;
            background-size: cover;
            height: 109vh;
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
            font-family: Arial, sans-serif;
        }

        .menu {
            display: flex;
            gap: 20px;
        }

        .menu ul {
            display: flex;
            list-style: none;
        }

        .menu ul li {
            margin: 0;
        }

        .menu ul li a {
            text-decoration: none;
            color: black;
            font-family: Arial, sans-serif;
            font-weight: bold;
            transition: 0.4s ease-in-out;
        }

        .hamburger {
            display: none;
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

        .menu-mobile {
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

        .menu-mobile ul {
            flex-direction: column;
            gap: 10px;
            display: flex;
            list-style: none;
            padding: 0;
        }

        .menu-mobile ul li {
            margin: 0;
        }

        .menu-mobile ul li a {
            text-decoration: none;
            color: black;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-top: 20px;
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
            font-size: 0.9em;
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

        .but a {
            text-decoration: none;
            color: black;
        }

        @media (max-width: 768px) {
            .menu {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .menu-mobile {
                display: none; /* Hide by default */
            }

            .menu-active {
                display: block; /* Show when active */
            }

            .content-table {
                display: none;
            }

            .card {
                display: block;
                width: 90%;
                max-width: 600px;
            }
        }
    </style>
</head>
<body>


    <div class="hai">
        <div class="navbar">
            <div class="logo">Apna_Gadi</div>
            <div class="menu">
                <ul>
                    <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                    <li><a href="adminusers.php">USERS</a></li>
                    <li><a href="admindash.php">FEEDBACKS</a></li>
                    <li><a href="adminbook.php">BOOKING REQUEST</a></li>
                    <li><button class="add"><a href="index.php">LOGOUT</a></button></li>
                </ul>
            </div>
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="menu-mobile" id="mobileMenu">
                <ul>
                    <li><a href="adminvehicle.php">VEHICLE MANAGEMENT</a></li>
                    <li><a href="adminusers.php">USERS</a></li>
                    <li><a href="admindash.php">FEEDBACKS</a></li>
                    <li><a href="adminbook.php">BOOKING REQUEST</a></li>
                    <li><button class="add"><a href="index.php">LOGOUT</a></button></li>
                </ul>
            </div>
        </div>

        <h1 class="header">USERS</h1>
        
        <div class="content-table">
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>LICENSE NUMBER</th>
                        <th>PHONE NUMBER</th>
                        <th>GENDER</th>
                        <th>DELETE USERS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($res = mysqli_fetch_array($queryy)) { ?>
                    <tr>
                        <td><?php echo $res['FNAME'] . " " . $res['LNAME']; ?></td>
                        <td><?php echo $res['EMAIL']; ?></td>
                        <td><?php echo $res['LIC_NUM']; ?></td>
                        <td><?php echo $res['PHONE_NUMBER']; ?></td>
                        <td><?php echo $res['GENDER']; ?></td>
                        <td><button type="button" class="but"><a href="deleteuser.php?id=<?php echo $res['EMAIL']; ?>">DELETE USER</a></button></td>
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
                <h3>Name: <?php echo $res['FNAME'] . " " . $res['LNAME']; ?></h3>
                <p><strong>Email:</strong> <?php echo $res['EMAIL']; ?></p>
                <p><strong>License Number:</strong> <?php echo $res['LIC_NUM']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $res['PHONE_NUMBER']; ?></p>
                <p><strong>Gender:</strong> <?php echo $res['GENDER']; ?></p>
                <a href="deleteuser.php?id=<?php echo $res['EMAIL']; ?>" class="but">DELETE USER</a>
            </div>
            <?php } ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('mobileMenu');
            menu.classList.toggle('menu-active');
        }
    </script>
</body>
</html>
