<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News and Events</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 30px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="textarea"],
select {
    width: 60%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="file"] {
    margin-bottom: 20px;
    padding: 5px;
    border: 1px solid black;
}

input[type="submit"] {
    width: 70%;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 70px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

.message {
    margin-top: 20px;
    text-align: center;
    color: #007bff;
    font-size: 18px;
}

.error-message {
    color: #dc3545;
}

.success-message {
    color: #28a745;
}

    </style>
</head>
<body>
    <?php
    $host = 'localhost';
    $db = 'julis';
    $user = 'root';
    $pass = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

            $stmt = $conn->prepare("INSERT INTO news_events (title, category, image) VALUES (:title, :category, :image)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':image', $image);
            
            if ($stmt->execute()) {
                echo "News/Event added successfully!";
            } else {
                echo "Error adding News/Event.";
            }
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>
<div class="container">
    <h1>Add News and Events</h1>
    <form method="post" enctype="multipart/form-data">
        <div>
            <!-- <label for="title">Title:</label> -->
            <input type="textarea" name="title" placeholder="Enter your title" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <select name="category" required>
                <option value="football">Football</option>
                <option value="cricket">Cricket</option>
                <option value="volleyball">Volleyball</option>
            </select>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" required>
        </div>
        <div>
            <input type="submit" name="submit" value="Add News/Event">
        </div>
    </form>
    </div>
</body>
</html>
