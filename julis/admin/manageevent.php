<?php include './header.php'; ?>

<div id="events" style="margin-left: 100px; margin-right:50px; margin-bottom:50px;">
  <form id="search-form" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <input type="submit" value="Search">
  </form>
  <form method="add-event.php" action="post">
    
    <h2>Manage events</h2>

    <fieldset>
      <legend>Add event</legend>
      <input type="button" value="Add football event" onclick="window.location.href='./addevent.php'">
      <input type="button" value="Add cricket event" onclick="window.location.href='./add-cricket.php'">
      <input type="button" value="Add volleyball event" onclick="window.location.href='./add-volleyball.php'">
    </fieldset>
  </form>

  <form method="post">
    <table>
      <tr class="black">
        <th>Event ID</th>
        <th>Team 1</th>
        <th>Team 2</th>
        <th>Team 1 Points</th>
        <th>Team 2 Points</th>
        <th>Event Date</th>
        <th>Event Location</th>
        <th>Actions</th>
      </tr>
      <?php
$conn = new mysqli('localhost', 'root', '', 'julis');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_term = isset($_GET['search']) ? $_GET['search'] : '';
$sql_count = "SELECT COUNT(*) as total FROM events
              LEFT JOIN teams AS team1 ON events.team1_id = team1.team_id
              LEFT JOIN teams AS team2 ON events.team2_id = team2.team_id
              LEFT JOIN team_stadiums ON events.stadium_id = team_stadiums.id
              WHERE team1.team_name LIKE '%$search_term%'
              OR team2.team_name LIKE '%$search_term%'
              OR team_stadiums.stadium_name LIKE '%$search_term%'";
$result_count = $conn->query($sql_count);
$total_events = $result_count->fetch_assoc()['total'];

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;
$limit = "LIMIT $offset, $items_per_page";

$sql = "SELECT events.*, team1.team_name AS team1_name, team2.team_name AS team2_name, team_stadiums.stadium_name AS event_stadium
        FROM events
        LEFT JOIN teams AS team1 ON events.team1_id = team1.team_id
        LEFT JOIN teams AS team2 ON events.team2_id = team2.team_id
        LEFT JOIN team_stadiums ON events.stadium_id = team_stadiums.id
        WHERE team1.team_name LIKE '%$search_term%'
        OR team2.team_name LIKE '%$search_term%'
        OR team_stadiums.stadium_name LIKE '%$search_term%'
        $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["team1_name"] . "</td>";
        echo "<td>" . $row["team2_name"] . "</td>";
        echo "<td>" . $row["team1_point"] . "</td>";
        echo "<td>" . $row["team2_point"] . "</td>";
        echo "<td>" . $row["event_date"] . "</td>";
        echo "<td>" . $row["event_stadium"] . "</td>";
        echo "<td class='button-cell'>";
        echo "<form method='post' action='edit-event.php'>";
        echo "<input type='hidden' name='event_id' value='" . $row["id"] . "'>";
        echo "<button type='submit'>Edit</button>";
        echo "</form>";
        echo "<form method='post' action='delete-event.php' onsubmit='return confirm(\"Are you sure you want to delete this event?\")'>";
        echo "<input type='hidden' name='event_id' value='" . $row["id"] . "'>";
        echo "<button type='submit'>Delete</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }

    if ($page > 1) {
        echo "<tr><td colspan='8' style='text-align: right;'>";
        echo "<a class='btn-prev' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) . "&search=$search_term'>Previous</a>";
        echo "</td></tr>";
    }

    if ($offset + $items_per_page < $total_events) {
        echo "<tr><td colspan='8'>";
        echo "<a class='btn-next' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) . "&search=$search_term'>Next</a>";
        echo "</td></tr>";
    }
} else {
    echo "<tr><td colspan='8'>No events found.</td></tr>";
}

$conn->close();
?>



    </table>
  </form>
</div>
