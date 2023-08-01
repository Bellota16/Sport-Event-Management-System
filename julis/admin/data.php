<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "julis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch team names from the "teams" table
$teamNames = array();
$sql = "SELECT team_name FROM teams";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teamNames[] = $row['team_name'];
    }
}

// Close the database connection
$conn->close();

// Return team names as JSON
header('Content-Type: application/json');
echo json_encode($teamNames);
?>
