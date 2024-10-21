<!DOCTYPE html>
<html>
<head>
    <title>Add Stadium</title>
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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stadium_name"], $_POST["stadium_city"], $_POST["stadium_category"])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "julis";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $stadium_name = $_POST["stadium_name"];
    $stadium_city = $_POST["stadium_city"];
    $stadium_category = $_POST["stadium_category"];

    // Prepare and execute the SQL statement to check if the stadium name already exists
    $check_sql = "SELECT stadium_name FROM team_stadiums WHERE stadium_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $stadium_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    // If a stadium with the same name already exists, show an error message and stop further execution
    if ($check_result->num_rows > 0) {
        $message = "Error adding stadium. Stadium with the same name already exists.";
    } else {
        // Prepare and execute the SQL statement to insert data into the "team_stadiums" table
        $insert_sql = "INSERT INTO team_stadiums (stadium_name, stadium_city, stadium_category)
                    VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sss", $stadium_name, $stadium_city, $stadium_category);

        if ($insert_stmt->execute()) {
            // Data inserted successfully
            $message = "Stadium added successfully.";
        } else {
            // Error in inserting data
            $message = "Error adding stadium. Please try again.";
        }

        $insert_stmt->close();
    }

    $conn->close();
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
<h1>Add Stadium</h1>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div>
        <label for="stadium_name">Stadium Name:</label>
        <input type="text" id="stadium_name" name="stadium_name" required>
    </div>
    <div>
        <label for="stadium_city">Stadium City:</label>
        <input type="text" id="stadium_city" name="stadium_city" required>
    </div>
    <div>
        <label for="stadium_category">Stadium Category:</label>
        <select id="stadium_category" name="stadium_category" required>
            <option value="Football">Football</option>
            <option value="Volleyball">Volleyball</option>
            <option value="Cricket">Cricket</option>
        </select>
    </div>
    <input type="submit" value="Add Stadium">
</form>
</body>
</html>
