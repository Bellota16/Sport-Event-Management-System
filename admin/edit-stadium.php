<?php
$conn = new mysqli('localhost', 'root', '', 'sport_event'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $stadium_id = $_POST["stadium_id"];
        $stadium_name = $_POST["stadium_name"];
        $stadium_category = $_POST["stadium_category"];
        $stadium_city = $_POST["stadium_city"];

        $sql = "UPDATE team_stadiums 
                SET stadium_name='$stadium_name', stadium_category='$stadium_category', stadium_city='$stadium_city' 
                WHERE id='$stadium_id'"; 

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-box">Stadium updated successfully</div>';
        } else {
            echo "Error updating stadium: " . $conn->error;
        }
    } else {
        $stadium_id = $_POST["stadium_id"];
        $sql = "SELECT * FROM team_stadiums WHERE id='$stadium_id'"; // Update the query to use 'id' instead of 'stadium_id'
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
            echo "<h2>Edit Stadium</h2>";
            echo "<input type='hidden' name='stadium_id' value='" . $row["id"] . "'>";
            echo "Stadium Name: <input type='text' name='stadium_name' value='" . $row["stadium_name"] . "'><br>";
            echo "Stadium Category: <select name='stadium_category'>";
            echo "<option value='football' " . ($row["stadium_category"] == "football" ? "selected" : "") . ">Football</option>";
            echo "<option value='volleyball' " . ($row["stadium_category"] == "volleyball" ? "selected" : "") . ">Volleyball</option>";
            echo "<option value='cricket' " . ($row["stadium_category"] == "cricket" ? "selected" : "") . ">Cricket</option>";
            echo "</select><br>";
            echo "Stadium City: <input type='text' name='stadium_city' value='" . $row["stadium_city"] . "'><br>";
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
            echo  '<script>alert "Stadium not found"</script>';
        }
    }
}

$conn->close();
?>
