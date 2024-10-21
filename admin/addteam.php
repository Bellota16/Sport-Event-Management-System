
<!DOCTYPE html>
<html>
<head>
    <title>Add Team</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 8px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 80%;
            margin-left: 10%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message,
.success-message {
    padding: 10px;
    border: 1px solid #ff0000; /* For error message, use #ff0000; for success message, use #008000 */
    border-radius: 5px;
    margin: 15px auto;
    width: 500px;
    text-align: center;
    font-size: 16px;
}

.error-message {
    background-color: #ffe0e0; /* Light red background for error message */
    color: #ff0000;
}

.success-message {
    background-color: #e0ffe0; /* Light green background for success message */
    color: #008000;
}

    </style>
</head>
<body>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sport_event";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $team_name = $_POST["team_name"];
    $team_country = $_POST["team_country"];
    $team_category = $_POST["team_category"];
    $team_location = $_POST["team_location"];
    $team_coach = $_POST["team_coach"];
    $team_players = $_POST["team_players"];

    // Prepare and execute the SQL statement to check if the team name already exists
    $check_sql = "SELECT team_name FROM teams WHERE team_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $team_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    // If a team with the same name already exists, show an error message and stop further execution
    if ($check_result->num_rows > 0) {
        $message = "Error adding team. Team with the same name already exists.";
        $check_stmt->close();
        $conn->close();
    } else {
        // Prepare and execute the SQL statement to insert data into the "teams" table
        $insert_sql = "INSERT INTO teams (team_name, team_country, team_category, team_location, team_coach, team_players)
                    VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssssss", $team_name, $team_country, $team_category, $team_location, $team_coach, $team_players);

        if ($insert_stmt->execute()) {
            // Data inserted successfully
            $message = "Team added successfully.";
        } else {
            // Error in inserting data
            $message = "Error adding team. Please try again.";
        }

        $insert_stmt->close();
        $conn->close();
    }
}
?>

<div class="message">
        <?php
        // Display the message with the appropriate CSS class
        if (!empty($message)) {
            if (strpos($message, 'Error') !== false) {
                echo '<div class="error-message">' . $message . '</div>';
            } else {
                echo '<div class="success-message">' . $message . '</div>';
            }
        }
        ?>
    </div>
    <h1>Add Team</h1>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div>
            <label for="team_name">Team Name:</label>
            <input type="text" id="team_name" name="team_name" required>
        </div>
        <div>
            <label for="team_country">Team Country:</label>
            <input type="text" id="team_country" name="team_country" required>
        </div>
        <div>
            <label for="team_category">Team Category:</label>
            <select id="team_category" name="team_category" required>
                <option value="Football">Football</option>
                <option value="Volleyball">Volleyball</option>
                <option value="Cricket">Cricket</option>
            </select>
        </div>
        <div>
            <label for="team_location">Team city:</label>
            <input type="text" id="team_location" name="team_location" required>
        </div>
        <div>
            <label for="team_coach">Team Coach:</label>
            <input type="text" id="team_coach" name="team_coach" required>
        </div>
        <div>
            <label for="team_players">Team Players:</label>
            <input type="text" id="team_players" name="team_players" required>
        </div>
        <input type="submit" value="Add Team">
    </form 
</body>
</html>
