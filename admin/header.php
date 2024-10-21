<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="./style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-image: url('picture2.jpg'); /* Use the correct path to your image */
      background-size: cover;
      background-position: center;
      color: #fff;
    }

    header {
      background-color: #333;
      padding: 20px;
      text-align: center;
    }

    nav {
      background-color: #222;
      padding: 10px;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    nav ul li {
      display: inline-block;
      margin-right: 10px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
      padding: 5px 10px;
    }

    nav ul li a:hover {
      background-color: #555;
    }

    section {
      padding: 20px;
      text-align: center;
    }

    footer {
      background-color: #333;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <h1 style="color: white;">SPORTS EVENT MANAGEMENT SYSTEM</h1>
  </header>

  <nav>
    <ul>
      <li><a href="./dashbord.php">Dashboard</a></li>
      <li><a href="./manageteam.php">Manage teams</a></li>
      <li><a href="./manageevent.php">Manage events</a></li>
      <li><a href="./managestadium.php">Manage stadiums</a></li>
      <li><a href="./managenew.php">Manage news and events</a></li>
      <li><a href="../signup/logout.php">Logout</a></li>
    </ul>
  </nav>
</body>
</html>
