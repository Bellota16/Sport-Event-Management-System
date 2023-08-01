<?php
include "./btn.php";
?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database_name = "julis";

$conn = new mysqli($servername, $username, $password, $database_name);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_date = date("Y-m-d");

// SQL query to retrieve upcoming, recent, and today's events with the "football" category
$sql_upcoming = "SELECT * FROM events WHERE event_category = 'volleyball' AND event_date > '$current_date' ORDER BY event_date";
$sql_recent = "SELECT * FROM events WHERE event_category = 'volleyball' AND event_date < '$current_date' ORDER BY event_date DESC";
$sql_today = "SELECT * FROM events WHERE event_category = 'volleyball' AND event_date = '$current_date'";
$result_upcoming = $conn->query($sql_upcoming);
$result_recent = $conn->query($sql_recent);
$result_today = $conn->query($sql_today);
function getTeamName($conn, $team_id) {
    $team_query = "SELECT team_name FROM teams WHERE team_id = $team_id";
    $team_result = $conn->query($team_query);
    if ($team_result->num_rows > 0) {
        $team_row = $team_result->fetch_assoc();
        return $team_row["team_name"];
    }
    return "";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cricket Events</title>
    <style>
        body{
            margin-top: 20px;
            background-color: black;
        }
        .event-container {
            display: none;
        }

        .event-container.active {
            display: block;
        }
        .upcoming{
            display: flex;
            flex: row;
        }
        
        button {
        margin-top: 20px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
        }
        .row{
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        input[type="text"]#team-search {
      width: 200px;
      padding: 8px;
      border: 2px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
      font-size: 16px;
      color: #333;
    }
    ::placeholder {
      color: #999;
    }
    </style>
</head>
<body>
    <button onclick="showRecentEvents()">Recent Events</button>
    <button onclick="showUpcomingEvents()">Upcoming Events</button>
    <button onclick="showTodayEvents()">Today's Events</button>

<div class="row">
<body>
    <div style="color: white;">
        <h2>Volleyball Teams:</h2>
        <div class="search-container">
            <input type="text" id="team-search" placeholder="Search team...">
            <button onclick="filterTeams()">Search</button>
        </div>
        <div id="team-list">
            <?php
            $sql_teams = "SELECT * FROM teams WHERE team_category = 'volleyball' ORDER BY team_name";
            $result_teams = $conn->query($sql_teams);

            if ($result_teams->num_rows > 0) {
                $team_number = 1;
                while ($team_row = $result_teams->fetch_assoc()) {
                    echo '<p class="team-item">' . $team_number . '. ' . $team_row["team_name"] . '</p>';
                    $team_number++;
                }
            } else {
                echo "No cricket teams found.";
            }
            ?>
        </div>
    </div>

    <div class="event-container active" id="recent-events" style="color: white;">
        <?php
        if ($result_recent->num_rows > 0) {
            echo "<h2>Recent Events:</h2>";
            while ($row = $result_recent->fetch_assoc()) {
                            
            echo '<div style="background-color: grey; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">';
            echo getTeamName($conn, $row["team1_id"]) . '&nbsp;';
            echo '<strong>' . $row["team1_point"] . ' :</strong>&nbsp;';
            echo '<strong>' . $row["team2_point"] . '</strong>&nbsp;';
            echo getTeamName($conn, $row["team2_id"]) . '&nbsp;<br>';
            echo '</div>';
                
            }
        } else {
            echo "No recent volleyball event found.";
        }
        ?>
    </div>

    <div class="event-container" id="upcoming-events" style="color: white;">
        <?php
        if ($result_upcoming->num_rows > 0) {
            echo "<h2>Upcoming Events:</h2>";
            while ($row = $result_upcoming->fetch_assoc()) {
                echo '<div style="background-color: grey; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">';
                echo getTeamName($conn, $row["team1_id"]) . '&nbsp;';
                echo '<strong>' . $row["team1_point"] . ' :</strong>&nbsp;';
                echo '<strong>' . $row["team2_point"] . '</strong>&nbsp;';
                echo getTeamName($conn, $row["team2_id"]) . '&nbsp;<br>';
                echo '</div>';
            }
        } else {
            echo "No upcoming volleyball events.";
        }
        ?>
    </div>

    <div class="event-container" id="today-events" style="color: white;">
        <?php
        if ($result_today->num_rows > 0) {
            echo "<h2>Today's Events:</h2>";
            while ($row = $result_today->fetch_assoc()) {
                echo '<div style="background-color: grey; color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">';
                echo getTeamName($conn, $row["team1_id"]) . '&nbsp;';
                echo '<strong>' . $row["team1_point"] . ' :</strong>&nbsp;';
                echo '<strong>' . $row["team2_point"] . '</strong>&nbsp;';
                echo getTeamName($conn, $row["team2_id"]) . '&nbsp;<br>';
                echo '</div>';
            }
        } else {
            echo "No events volleyball event found for today.";
        }
        ?>
    </div>

    </div>
    <script>
        function showRecentEvents() {
            document.getElementById("recent-events").classList.add("active");
            document.getElementById("upcoming-events").classList.remove("active");
            document.getElementById("today-events").classList.remove("active");
        }

        function showUpcomingEvents() {
            document.getElementById("recent-events").classList.remove("active");
            document.getElementById("upcoming-events").classList.add("active");
            document.getElementById("today-events").classList.remove("active");
        }

        function showTodayEvents() {
            document.getElementById("recent-events").classList.remove("active");
            document.getElementById("upcoming-events").classList.remove("active");
            document.getElementById("today-events").classList.add("active");
        }
    </script>


    </div>
    <script>
    // Function to filter teams based on the search input
    function filterTeams() {
        const filterValue = document.getElementById('team-search').value.toLowerCase();
        const teamItems = document.querySelectorAll('.team-item');

        teamItems.forEach((item) => {
            const teamName = item.textContent.toLowerCase();
            if (teamName.includes(filterValue)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
