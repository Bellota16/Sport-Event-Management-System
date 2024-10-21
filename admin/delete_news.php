<?php
// Check if the delete button is clicked and the ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
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

    // Prepare and execute the SQL statement to delete data from the "team_stadiums" table
    $delete_sql = "DELETE FROM news_events WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $_POST['id']);

    if ($delete_stmt->execute()) {
        $message = "news/event deleted successfully.";
    } else {
        $message = "Error deleting stadium. Please try again.";
    }

    $delete_stmt->close();
    $conn->close();
    
    // Redirect back to the managestadium.php page with the search query string
    $search_query = isset($_GET['search']) ? "?search=" . urlencode($_GET['search']) : "";
    header("Location: ./managenew.php" . $search_query);
    exit();
} else {
    header("Location: ./managenew.php");
    exit();
}
?>
