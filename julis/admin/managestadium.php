<?php include 'header.php'; ?>

<div id="stadiums" style="margin-left: 100px; margin-right:50px;">
  <form id="search-form" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <input type="submit" value="Search">
  </form>
  <form method="addstadium.php" action="post">
    <h2>Manage stadiums</h2>
    <div class="manage-btn">
      <input type="button" onclick="window.location.href='./addstadiums.php'" value="Add stadium">
    </div>
  </form>
  <form method="post">
    <table>
      <tr class="black">
        <th>Stadium id</th>
        <th>Stadium name</th>
        <th>Stadium event category</th>
        <th>Action</th>
      </tr>
      <?php
      $conn = new mysqli('localhost', 'root', '', 'julis');
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $search_term = isset($_GET['search']) ? $_GET['search'] : '';
      $sql_count = "SELECT COUNT(*) as total FROM team_stadiums WHERE stadium_name LIKE '%$search_term%'  OR stadium_category LIKE '%$search_term%'";
      $result_count = $conn->query($sql_count);
      $total_stadiums = $result_count->fetch_assoc()['total'];

      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
      $items_per_page = 5;
      $offset = ($page - 1) * $items_per_page;
      $limit = "LIMIT $offset, $items_per_page";

      $sql = "SELECT * FROM team_stadiums WHERE stadium_name LIKE '%$search_term%' OR  stadium_category LIKE '%$search_term%' $limit";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["stadium_name"] . "</td>";
              echo "<td>" . $row["stadium_category"] . "</td>";
              echo "<td class='button-cell'>";
              echo "<form method='post' action='edit-stadium.php'>";
              echo "<input type='hidden' name='stadium_id' value='" . $row["id"] . "'>";
              echo "<button type='submit'>Edit</button>";
              echo "</form>";
              echo "<form method='post' action='delete-stadium.php' onsubmit='return confirm(\"Are you sure you want to delete this stadium?\")'>";
              echo "<input type='hidden' name='stadium_id' value='" . $row["id"] . "'>";
              echo "<button type='submit'>Delete</button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";
          }

          if ($page > 1) {
            echo "<tr><td colspan='4'>";
            echo "<a class='btn-prev' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) . "&search=$search_term'>Previous</a>";
            echo "</td></tr>";
        }
        
        if ($offset + $items_per_page < $total_stadiums) {
            echo "<tr><td colspan='4'>";
            echo "<a class='btn-next' href='" . $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) . "&search=$search_term'>Next</a>";
            echo "</td></tr>";
          }
      } else {
          echo "<tr><td colspan='4'>No stadiums found.</td></tr>";
      }

      $conn->close();
      ?>
    </table>
  </form>
</div>
