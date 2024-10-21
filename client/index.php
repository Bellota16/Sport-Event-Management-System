<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Julis</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
        body {
    margin: 0;
    font-family: Arial, sans-serif;
}

header {
    background-color: #1a1a1a;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    display: flex;
    align-items: center;
    color: #ffffff;
}

.logo img {
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.logo span {
    font-size: 24px;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

nav li {
    display: inline-block;
    margin-left: 20px;
}

nav li:first-child {
    margin-left: 0;
}

nav a {
    color: #ffffff;
    text-decoration: none;
    font-size: 18px;
    padding: 10px 15px;
    transition: color 0.3s ease;
}

nav a:hover {
    color: #00ff66;
}
header {
    position: sticky;
    top: 0;
    z-index: 100;
}

header {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.logo span {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.logo img {
    border-radius: 50%;
    box-shadow: 0 0 4px rgba(255, 255, 255, 0.8);
}

nav {
    background-color: #1a1a1a;
    border-radius: 8px;
    overflow: hidden;
}

nav a {
    border-bottom: 2px solid transparent;
    transition: border-bottom 0.3s ease;
}

nav a:hover {
    border-bottom: 2px solid #00ff66;
}
header.sticky {
    background-color: rgba(26, 26, 26, 0.9);
    backdrop-filter: blur(10px);
}

header.sticky .logo span {
    color: #00ff66;
}

header.sticky nav a {
    color: #ffffff;
}

header.sticky nav a:hover {
    border-bottom-color: #ffffff    ;
}
/* Footer styles */
.footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

.footer-content {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-item {
    flex: 1;
    padding: 0 20px;
}

.footer-item h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.footer-item p {
    font-size: 14px;
}

.social-icons {
    margin-top: 10px;
}

.social-icons a {
    color: #fff;
    margin-right: 10px;
    font-size: 20px;
}

    </style>
</head>
<body>
    <header>
        <div class="logo">
            <span>JuLius</span>
        </div>
        <nav>
            <ul>
                <li><a href="./football.php">sports</a></li>
                <li><a href="./news_event.php">News and events</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="../signup/logout.php">Logout</a></li>
           
            </ul>
        </nav>
    </header>

</body>
</html>
