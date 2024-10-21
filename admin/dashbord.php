<?php
include "./header.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sport_event";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the number of teams
$sql = "SELECT COUNT(*) AS teamCount FROM teams";
$result = $conn->query($sql);
$teamCount = ($result->num_rows > 0) ? $result->fetch_assoc()['teamCount'] : 0;

// Fetch the number of stadiums
$sql = "SELECT COUNT(*) AS stadiumCount FROM team_stadiums";
$result = $conn->query($sql);
$stadiumCount = ($result->num_rows > 0) ? $result->fetch_assoc()['stadiumCount'] : 0;

// Fetch the number of events
$sql = "SELECT COUNT(*) AS eventCount FROM events";
$result = $conn->query($sql);
$eventCount = ($result->num_rows > 0) ? $result->fetch_assoc()['eventCount'] : 0;

// Fetch the number of users (assuming you have a users table)
$sql = "SELECT COUNT(*) AS userCount FROM users";
$result = $conn->query($sql);
$userCount = ($result->num_rows > 0) ? $result->fetch_assoc()['userCount'] : 0;

// Fetch the number of news and events
$sql = "SELECT COUNT(*) AS newsEventCount FROM news_events";
$result = $conn->query($sql);
$newsEventCount = ($result->num_rows > 0) ? $result->fetch_assoc()['newsEventCount'] : 0;

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 200px;
        }

        .card i {
            font-size: 36px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .card h3 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .card p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <i class="fas fa-users"></i>
            <h3><?php echo $teamCount; ?></h3>
            <p>Teams</p>
        </div>
        <div class="card">
            <i class="fas fa-trophy"></i>
            <h3><?php echo $stadiumCount; ?></h3>
            <p>Stadiums</p>
        </div>
        <div class="card">
            <i class="fas fa-calendar-alt"></i>
            <h3><?php echo $eventCount; ?></h3>
            <p>Events</p>
        </div>
        <div class="card">
            <i class="fas fa-users"></i>
            <h3><?php echo $userCount; ?></h3>
            <p>Users</p>
        </div>
        <div class="card">
            <i class="fas fa-newspaper"></i>
            <h3><?php echo $newsEventCount; ?></h3>
            <>News  & Events</</div>
            <p>News</p>
        </div>
    </div>
</body>
</html>
