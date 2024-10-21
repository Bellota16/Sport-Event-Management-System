<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage News and Events</title>
  <style>
    /* Styling for the button container */
    .btn-fixed-container {
      position: static;
      bottom: 0;
      left: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 10px 50px;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Styling for the buttons */
    .btn-next, .btn-prev {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
    }

    /* Ensure enough padding for the body to accommodate fixed buttons */
    body {
      padding-bottom: 60px;
    }
  </style>
</head>

<body>
  <div id="news-events" style="margin-left: 100px; margin-right: 50px;">
    <form id="search-form" method="GET">
      <input type="text" name="search" placeholder="Search...">
      <input type="submit" value="Search">
    </form>

    <form method="addnews_event.php" action="post">
      <h2>Manage News and Events</h2>
      <div class="manage-btn">
        <input type="button" onclick="window.location.href='./add_news.php'" value="Add News/Event">
      </div>
    </form>

    <form method="post">
      <table>
        <tr class="black">
          <th>Event ID</th>
          <th>Title</th>
          <th>Category</th>
          <th>Image</th>
          <th>Action</th>
        </tr>

        <?php
        $conn = new mysqli('localhost', 'root', '', 'sport_event');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $search_term = isset($_GET['search']) ? $_GET['search'] : '';
        $sql_count = "SELECT COUNT(*) as total FROM news_events WHERE title LIKE '%$search_term%' OR category LIKE '%$search_term%'";
        $result_count = $conn->query($sql_count);
        $total_news_events = $result_count->fetch_assoc()['total'];

        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $items_per_page = 5;
        $offset = ($page - 1) * $items_per_page;
        $limit = "LIMIT $offset, $items_per_page";

        $sql = "SELECT * FROM news_events WHERE title LIKE '%$search_term%' OR category LIKE '%$search_term%' $limit";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($row["image"]) . "' width='100'></td>";
                echo "<td class='button-cell'>";
                echo "<form method='post' action='edit_news.php'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<button type='submit'>Edit</button>";
                echo "</form>";
                echo "<form method='post' action='delete_news.php' onsubmit='return confirm(\"Are you sure you want to delete this news/event?\")'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<button type='submit'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No news/events found.</td></tr>";
        }

        $conn->close();
        ?>
      </table>
    </form>

    <!-- Fixed navigation buttons (always at the bottom of the page) -->
    <div class="btn-fixed-container">
      <?php if ($page > 1): ?>
        <a class="btn-prev" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $page - 1; ?>&search=<?php echo $search_term; ?>">Previous</a>
      <?php else: ?>
        <span></span> <!-- Placeholder to maintain space between buttons -->
      <?php endif; ?>

      <?php if ($offset + $items_per_page < $total_news_events): ?>
        <a class="btn-next" href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $page + 1; ?>&search=<?php echo $search_term; ?>">Next</a>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
