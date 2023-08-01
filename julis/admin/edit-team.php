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

        $sql = "UPDATE teams 
                SET team_name='$team_name', team_country='$team_country', team_category='$team_category', team_location='$team_location', team_coach='$team_coach', team_players='$team_players' 
                WHERE team_id='$team_id'"; 

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-box">Team updated successfully</div>';
        } else {
            echo "Error updating team: " . $conn->error;
        }
    } else {
        $team_id = $_POST["team_id"];
        $sql = "SELECT * FROM teams WHERE team_id='$team_id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
            echo "<h2>Edit Team</h2>";
            echo "<input type='hidden' name='team_id' value='" . $row["team_id"] . "'>";
            echo "Team Name: <input type='text' name='team_name' value='" . $row["team_name"] . "'><br>";
            echo "Team Country: <input type='text' name='team_country' value='" . $row["team_country"] . "'><br>";
            echo "Team Category: <select name='team_category'>";
            echo "<option value='Football' " . ($row["team_category"] == "Football" ? "selected" : "") . ">Football</option>";
            echo "<option value='Volleyball' " . ($row["team_category"] == "Volleyball" ? "selected" : "") . ">Volleyball</option>";
            echo "<option value='Cricket' " . ($row["team_category"] == "Cricket" ? "selected" : "") . ">Cricket</option>";
            echo "</select><br>";
            echo "Team Location: <input type='text' name='team_location' value='" . $row["team_location"] . "'><br>";
            echo "Team Coach: <input type='text' name='team_coach' value='" . $row["team_coach"] . "'><br>";
            echo "Team Players: <input type='text' name='team_players' value='" . $row["team_players"] . "'><br>";
            echo "<button type='submit' name='update'>Update</button>";
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
        
        } else {
            echo  '<script>alert "Team not found"</script>';
        }
    }
}

$conn->close();
?>
