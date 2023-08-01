<?php
// Check if the delete button is clicked and the ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
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

    // Prepare and execute the SQL statement to delete data from the "events" table
    $delete_sql = "DELETE FROM events WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $_POST['event_id']);

    if ($delete_stmt->execute()) {
        $message = "Event deleted successfully.";
    } else {
        $message = "Error deleting event. Please try again.";
    }

    $delete_stmt->close();
    $conn->close();
    header("Location: ./manageevent.php" . $_GET['search']);
    exit();
} else {
    header("Location: ./manageevent.php");
    exit();
}
?>
