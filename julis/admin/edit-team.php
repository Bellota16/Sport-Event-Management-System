<?php
$conn = new mysqli('localhost', 'root', '', 'julis');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $team_id = $_POST["team_id"];
        $team_name = $_POST["team_name"];
        $team_country = $_POST["team_country"];
        $team_category = $_POST["team_category"];
        $team_location = $_POST["team_location"];
        $team_coach = $_POST["team_coach"];
        $team_players = $_POST["team_players"];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE teams SET team_name=?, team_country=?, team_category=?, team_location=?, team_coach=?, team_players=? WHERE team_id=?");
        $stmt->bind_param("ssssssi", $team_name, $team_country, $team_category, $team_location, $team_coach, $team_players, $team_id);

        if ($stmt->execute()) {
            echo '<div class="success-box">Team updated successfully</div>';
        } else {
            echo "Error updating team: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $team_id = $_POST["team_id"];
        $stmt = $conn->prepare("SELECT * FROM teams WHERE team_id=?");
        $stmt->bind_param("i", $team_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
            echo "<h2>Edit Team</h2>";
            echo "<input type='hidden' name='team_id' value='" . htmlspecialchars($row["team_id"]) . "'>";
            echo "Team Name: <input type='text' name='team_name' value='" . htmlspecialchars($row["team_name"]) . "'><br>";
            echo "Team Country: <input type='text' name='team_country' value='" . htmlspecialchars($row["team_country"]) . "'><br>";
            echo "Team Category: <select name='team_category'>";
            echo "<option value='Football' " . ($row["team_category"] == "Football" ? "selected" : "") . ">Football</option>";
            echo "<option value='Volleyball' " . ($row["team_category"] == "Volleyball" ? "selected" : "") . ">Volleyball</option>";
            echo "<option value='Cricket' " . ($row["team_category"] == "Cricket" ? "selected" : "") . ">Cricket</option>";
            echo "</select><br>";
            echo "Team Location: <input type='text' name='team_location' value='" . htmlspecialchars($row["team_location"]) . "'><br>";
            echo "Team Coach: <input type='text' name='team_coach' value='" . htmlspecialchars($row["team_coach"]) . "'><br>";
            echo "Team Players: <input type='text' name='team_players' value='" . htmlspecialchars($row["team_players"]) . "'><br>";
            echo "<button type='submit' name='update'>Update</button>";
            echo "</form>";

            // CSS for styling
            echo "<style>
                form { max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.2); }
                label { display: block; font-weight: bold; }
                input[type=text], select { width: 100%; padding: 5px; border-radius: 3px; border: 1px solid #ccc; }
                button[type=submit] { margin-top: 10px; background-color: #007bff; color: #fff; padding: 8px 20px; border: none; border-radius: 3px; cursor: pointer; width: 80%; margin-left: 10%; }
                .error-message, .success-box { padding: 10px; border-radius: 5px; margin: 15px auto; width: 400px; text-align: center; font-size: 16px; }
                .error-message { background-color: #ffe0e0; color: #ff0000; border: 1px solid #ff0000; }
                .success-box { background-color: #e0ffe0; color: #008000; border: 1px solid #008000; }
            </style>";
        } else {
            echo '<script>alert("Team not found");</script>'; // Fixed alert syntax
        }
        $stmt->close();
    }
}

$conn->close();
?>
