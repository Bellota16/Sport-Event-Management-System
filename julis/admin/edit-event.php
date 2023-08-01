<?php
$conn = new mysqli('localhost', 'root', '', 'julis');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getTeamsOptions($conn, $selectedTeamId)
{
    $sql = "SELECT team_id, team_name FROM teams";
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
    $sql = "SELECT id, stadium_name FROM team_stadiums";
    $result = $conn->query($sql);
    $options = "";
    while ($row = $result->fetch_assoc()) {
        $selected = ($row['id'] == $selectedStadiumId) ? 'selected' : '';
        $options .= "<option value='" . $row['id'] . "' $selected>" . $row['stadium_name'] . "</option>";
    }
    return $options;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $event_id = $_POST["event_id"];
        $team1_id = $_POST["team1_id"];
        $team2_id = $_POST["team2_id"];
        $team1_point = $_POST["team1_point"];
        $team2_point = $_POST["team2_point"];
        $stadium_id = $_POST["stadium_id"];

        $sql = "UPDATE events 
                SET team1_id='$team1_id', team2_id='$team2_id', team1_point='$team1_point', team2_point='$team2_point', stadium_id='$stadium_id' 
                WHERE id='$event_id'";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-box">Event updated successfully</div>';
        } else {
            echo "Error updating event: " . $conn->error;
        }
    } else {
        $event_id = $_POST["event_id"];
        $sql = "SELECT * FROM events WHERE id='$event_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
            echo "<h2>Edit Event</h2>";
            echo "<input type='hidden' name='event_id' value='" . $row["id"] . "'>";
            echo "Team 1 ID: <select name='team1_id'>" . getTeamsOptions($conn, $row["team1_id"]) . "</select><br>";
            echo "Team 2 ID: <select name='team2_id'>" . getTeamsOptions($conn, $row["team2_id"]) . "</select><br>";
            echo "Team 1 Points: <input type='number' name='team1_point' value='" . $row["team1_point"] . "'><br>";
            echo "Team 2 Points: <input type='number' name='team2_point' value='" . $row["team2_point"] . "'><br>";
            echo "Stadium: <select name='stadium_id'>" . getStadiumsOptions($conn, $row["stadium_id"]) . "</select><br>";
            echo "Event Category: <select name='event_category'>";
            echo "<option value='football' " . ($row["event_category"] == "football" ? "selected" : "") . ">Football</option>";
            echo "<option value='volleyball' " . ($row["event_category"] == "volleyball" ? "selected" : "") . ">Volleyball</option>";
            echo "<option value='cricket' " . ($row["event_category"] == "cricket" ? "selected" : "") . ">Cricket</option>";
            echo "</select><br>";
            echo "Event Date: <input type='date' name='event_date' value='" . $row["event_date"] . "'><br>";
            echo "<button type='submit' name='update'>Update</button>";
            echo "</form>";
            echo "<style>";
            // Your CSS styles here
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

        } else {
            echo  '<script>alert("Event not found")</script>';
        }
    }
}

$conn->close();
?>
