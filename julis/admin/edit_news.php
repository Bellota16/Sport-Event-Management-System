<?php
$conn = new mysqli('localhost', 'root', '', 'julis');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $news_event_id = $_POST["news_event_id"];
        $title = $_POST["title"];
        $category = $_POST["category"];
        $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

        $sql = "UPDATE news_events 
                SET title='$title', category='$category', image='$image' 
                WHERE id='$news_event_id'"; 

        if ($conn->query($sql) === TRUE) {
            echo '<div class="success-box">News/Event updated successfully</div>';
        } else {
            echo "Error updating News/Event: " . $conn->error;
        }
    } else {
        $id = $_POST["id"];
        $sql = "SELECT * FROM news_events WHERE id='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>";
            echo "<h2>Edit News/Event</h2>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "Title: <input type='text' name='title' value='" . $row["title"] . "''><br>";
            echo "Category: <select name='category'>";
            echo "<option value='Football' " . ($row["category"] == "Football" ? "selected" : "") . ">Football</option>";
            echo "<option value='Volleyball' " . ($row["category"] == "Volleyball" ? "selected" : "") . ">Volleyball</option>";
            echo "<option value='Cricket' " . ($row["category"] == "Cricket" ? "selected" : "") . ">Cricket</option>";
            echo "</select><br>";
            echo "Image: <input type='file' name='image'><br>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' width='100'><br>";
            echo "<button type='submit' name='update'>Update</button>";
            echo "</form>";
            echo "<style>";
            echo "form {
                max-width: 400px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            }";

            echo "label {
                display: block;
                font-weight: bold;
            }";
           
            echo "input[type=text], select {
                width: 100%;
                padding: 5px;
                border-radius: 3px;
                border: 1px solid #ccc;
            }";

            echo "button[type=submit] {
                margin-top: 10px;
                background-color: #007bff;
                color: #fff;
                padding: 8px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                width: 80%;
                margin-left: 10%;
            }";

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

            echo ".error-message {
                    background-color: #ffe0e0; 
                    color: #ff0000;
                }";

            echo ".success-box {
                    background-color: #e0ffe0;
                    color: #008000;
                }";
            echo "</style>";
        
        } else {
            echo  '<script>alert "News/Event not found"</script>';
        }
    }
}

$conn->close();
?>
