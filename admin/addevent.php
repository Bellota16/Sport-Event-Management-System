<?php
$conn = new mysqli('localhost', 'root', '', 'sport_event');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getTeamsOptions($conn, $selectedTeamId)
{
    $sql = "SELECT team_id, team_name FROM teams WHERE team_category='football'";
    $result = $conn->query($sql);
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $selected = ($row['team_id'] == $selectedTeamId) ? 'selected' : '';
        $options .= "<option value='" . $row['team_id'] . "' $selected>" . $row['team_name'] . "</option>";
    }
    return $options;
}

function getStadiumsOptions($conn, $selectedStadiumId)
{
    $sql = "SELECT id, stadium_name FROM team_stadiums WHERE stadium_category='football'";
    $result = $conn->query($sql);
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $selected = ($row['id'] == $selectedStadiumId) ? 'selected' : '';
        $options .= "<option value='" . $row['id'] . "' $selected>" . $row['stadium_name'] . "</option>";
    }
    return $options;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) { // Check if "Add Event" button is clicked
        // Code to add a new event to the database
        $team1_id = isset($_POST["team1_id"]) ? $_POST["team1_id"] : '';
        $team2_id = isset($_POST["team2_id"]) ? $_POST["team2_id"] : '';
        
        // Check if both team1_id and team2_id are the same
        if ($team1_id === $team2_id) {
            die('<div class="error-message">Error: Team 1 and Team 2 cannot be the same.</div>');
        }
        
        $team1_point = $_POST["team1_point"];
        $team2_point = $_POST["team2_point"];
        $stadium_id = isset($_POST["stadium_id"]) ? $_POST["stadium_id"] : '';
        $event_category = "football"; // Always set event_category to "football"
        $event_date = $_POST["event_date"];

        $sql = "INSERT INTO events (team1_id, team2_id, team1_point, team2_point, stadium_id, event_category, event_date)
                VALUES ('$team1_id', '$team2_id', '$team1_point', '$team2_point', '$stadium_id', '$event_category', '$event_date')";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-box">Event added successfully</div>';
        } else {
            echo "Error adding event: " . $conn->error;
        }
    }
}

// Show empty input boxes and selects for adding a new event
echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
echo "<h2>Add Event</h2>";
echo "Team 1 ID: <select name='team1_id'>" . getTeamsOptions($conn, '') . "</select><br>";
echo "Team 2 ID: <select name='team2_id'>" . getTeamsOptions($conn, '') . "</select><br>";
echo "Team 1 Points: <input type='number' name='team1_point'><br>";
echo "Team 2 Points: <input type='number' name='team2_point'><br>";
echo "Stadium: <select name='stadium_id'>" . getStadiumsOptions($conn, '') . "</select><br>";
echo "Event Date: <input type='date' name='event_date'><br>";
echo "<button type='submit' name='add'>Add Event</button>";
echo "</form>";
echo "<style>";
echo "form {   max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);}";

echo "label { display: block; font-weight: bold; }";

echo "input[type=text], select { width: 100%;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc; }";

echo "button[type=submit] { margin-top: 10px;
    background-color: #007bff;
    color: #fff;
    padding: 8px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    width: 80%;
    margin-left: 10%;}";
echo "error-message,
    .success-box {
        padding: 10px;
        border: 1px solid #ff0000;
        border-radius: 5px;
        margin: 15px auto;
        width: 400px;
        text-align: center;
        font-size: 16px;
    }";
echo " .error-message {
        background-color: #ffe0e0; 
        color: #ff0000;
    }";
echo ".success-box {
        background-color: #e0ffe0;
        color: #008000;
    }";
echo "</style>";

$conn->close();
?>
