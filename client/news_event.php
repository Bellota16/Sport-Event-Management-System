<?php
include "./index.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News and Events</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}

    .card {
    width: 300px;
    height: 300px; /* Set the height to the desired fixed size */
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    padding: 20px;
    margin: 20px;
    text-align: center;
    background-color: #ffffff;
    transition: transform 0.3s;
    display: inline-block;
    overflow: hidden; /* Hide any content that overflows the fixed size */
}

.card img {
    width: 100%;
    height: 150px; /* Set the height for the image */
    object-fit: cover; /* Make sure the image fills the square */
    border-radius: 10px 10px 0 0; /* Rounded corners for the top */
}

.card h3 {
    margin: 0;
    font-size: 14px;
    color: #007bff;
}

.card p {
    color: #555;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 10px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #004999;
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

        $stmt = $conn->query("SELECT * FROM news_events");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            $title = $row['title'];
            $category = $row['category'];
            $imageData = $row['image'];

            echo '<div class="card">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image">';
            echo '<h3>' . $title . '</h3>';
            echo '<p>' . $category . '</p>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    ?>
    <?php
include "./footer.php";
?>
</body>
</html>
