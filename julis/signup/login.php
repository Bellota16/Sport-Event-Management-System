<?php
require '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
         body {
  font-family: Arial, sans-serif;
  background-color: #e8f4f8;
}

.container {
  width: 400px;
  margin: 100px auto;
  background-color: #ffffff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.login h1 {
  text-align: center;
  margin-bottom: 30px;
  color: #333333;
}

form {
  width: 100%;
}

.form-group {
  margin-bottom: 20px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 6px;
  background-color: #f1f1f1;
}

input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  background-color: #e1e1e1;
}

input[type="submit"] {
  width: 100%;
  background-color: #007bff;
  color: #ffffff;
  cursor: pointer;
  border: none;
  height: 40px;
  border-radius: 6px;
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

p {
  text-align: center;
  margin-top: 20px;
  color: #777777;
}

a {
  color: #007bff;
  text-decoration: none;
}

.error-msg {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #ff0000;
  color: #ffffff;
  padding: 10px;
  margin-bottom: 10px;
  text-align: center;
  border-radius: 6px;
}

        
    </style>
</head>
<body>
<div class="container">
<div id="loginPopup">
    <div class="popup-content">
        <form method="post" action="#">
            <div>
                <h1>Login</h1>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" id="username-email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" id="password" required>
            </div>
        
            <input type="submit" name="login">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            
            <?php
$conn = new mysqli('localhost', 'root', '', 'julis');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt_admin->bind_param("ss", $username, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    $stmt_users = $conn->prepare("SELECT * FROM users WHERE (username = ? OR email = ?) AND password = ?");
    $stmt_users->bind_param("sss", $username, $username, $password);
    $stmt_users->execute();
    $result_users = $stmt_users->get_result();

    if ($result_admin->num_rows == 1) {
        $row = $result_admin->fetch_assoc();
        $_SESSION['username'] = $row['email'];
        header("Location: ../admin/index.php");
        exit();
    } elseif ($result_users->num_rows == 1) {
        $row = $result_users->fetch_assoc();
        $_SESSION['username'] = $row['email'];
        header("Location: ../client/include.php");
        exit();
    } else {
        echo "<script>
            var errorMsg = document.createElement('div');
            errorMsg.classList.add('error-msg');

            var icon = document.createElement('i');
            icon.classList.add('fa', 'fa-exclamation-circle');
            icon.style.marginRight = '5px';
            icon.style.display = 'inline-block';
            icon.style.verticalAlign = 'middle';

            var message = document.createElement('span');
            message.innerText = 'Incorrect username or password. Please try again.';
            message.style.display = 'inline-block';
            message.style.verticalAlign = 'middle';

            errorMsg.appendChild(icon);
            errorMsg.appendChild(message);

            document.body.appendChild(errorMsg);

            document.addEventListener('click', function() {
                errorMsg.style.display = 'none';
            });
        </script>";

        echo "<style>
            .error-msg {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                background-color: #ff0000;
                color: #ffffff;
                padding: 10px;
                margin-bottom: 10px;
                text-align: center;
            }
        </style>";
    }

    $stmt_admin->close();
    $stmt_users->close();
}

$conn->close();
?>



        </form>
    </div>
</div>
</div>
</body>
</html>


    