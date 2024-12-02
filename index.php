<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "daily_log";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $wakeupTime = $_POST['wakeupTime'];
    $physicalActivity = $_POST['physicalActivity'];
    $foodTime = $_POST['foodTime'];
    $lunch = $_POST['lunch'];
    $breakfast = $_POST['breakfast'];
    $snacks = $_POST['snacks'];
    $dinner = $_POST['dinner'];
    $akantDhyan = $_POST['akantDhyan'];
    $samuhikDhyan = $_POST['samuhikDhyan'];
    $unhealthyFood = $_POST['unhealthyFood'];
    $healthyFood = $_POST['healthyFood'];
    $sleepTime = $_POST['sleepTime'];

    // Insert data into the database
    $sql = "INSERT INTO logs (name, wakeup_time, physical_activity, food_time, lunch, breakfast, snacks, dinner, akant_dhyan, samuhik_dhyan, unhealthy_food, healthy_food, sleep_time) 
            VALUES ('$name', '$wakeupTime', '$physicalActivity', '$foodTime', '$lunch', '$breakfast', '$snacks', '$dinner', '$akantDhyan', '$samuhikDhyan', '$unhealthyFood', '$healthyFood', '$sleepTime')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . " - " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #83a4d4, #b6fbff);
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            background: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.2s ease;
        }
        form label {
            display: block;
            margin: 10px 0 5px;
        }
        form input, form textarea, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        form button {
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background: #45a049;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #ddd;
            transition: background-color 0.3s ease;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <h1>Daily Log</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="wakeupTime">Wakeup Time:</label>
        <input type="time" name="wakeupTime" id="wakeupTime" required>

        <label for="physicalActivity">Physical Activity:</label>
        <input type="text" name="physicalActivity" id="physicalActivity">

        <label for="foodTime">Food Time:</label>
        <input type="text" name="foodTime" id="foodTime">

        <label for="lunch">What did you eat in lunch?</label>
        <textarea name="lunch" id="lunch"></textarea>

        <label for="breakfast">What did you eat in breakfast?</label>
        <textarea name="breakfast" id="breakfast"></textarea>

        <label for="snacks">What did you eat in evening snacks?</label>
        <textarea name="snacks" id="snacks"></textarea>

        <label for="dinner">What did you eat in dinner?</label>
        <textarea name="dinner" id="dinner"></textarea>

        <label for="akantDhyan">Akant Dhyan:</label>
        <select name="akantDhyan" id="akantDhyan">
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>

        <label for="samuhikDhyan">Samuhik Dhyan:</label>
        <select name="samuhikDhyan" id="samuhikDhyan">
            <option value="YES">YES</option>
            <option value="NO">NO</option>
        </select>

        <label for="unhealthyFood">Unhealthy Food:</label>
        <textarea name="unhealthyFood" id="unhealthyFood"></textarea>

        <label for="healthyFood">Healthy Food:</label>
        <textarea name="healthyFood" id="healthyFood"></textarea>

        <label for="sleepTime">Sleep Time:</label>
        <input type="time" name="sleepTime" id="sleepTime" required>

        <button type="submit">Submit</button>
    </form>

    <h2>Daily Log Records</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Wakeup Time</th>
                <th>Physical Activity</th>
                <th>Food Time</th>
                <th>Lunch</th>
                <th>Breakfast</th>
                <th>Snacks</th>
                <th>Dinner</th>
                <th>Akant Dhyan</th>
                <th>Samuhik Dhyan</th>
                <th>Unhealthy Food</th>
                <th>Healthy Food</th>
                <th>Sleep Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display records
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM logs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['wakeup_time'] . "</td>
                        <td>" . $row['physical_activity'] . "</td>
                        <td>" . $row['food_time'] . "</td>
                        <td>" . $row['lunch'] . "</td>
                        <td>" . $row['breakfast'] . "</td>
                        <td>" . $row['snacks'] . "</td>
                        <td>" . $row['dinner'] . "</td>
                        <td>" . $row['akant_dhyan'] . "</td>
                        <td>" . $row['samuhik_dhyan'] . "</td>
                        <td>" . $row['unhealthy_food'] . "</td>
                        <td>" . $row['healthy_food'] . "</td>
                        <td>" . $row['sleep_time'] . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='13'>No records found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
