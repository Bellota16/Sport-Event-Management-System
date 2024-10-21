<body>
  <?php
  require '../session/session.php';
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Event Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
      body {
        font-family: 'Roboto', sans-serif;
        background: url('picture1.jpg') no-repeat center center fixed;
        /* Use uploaded image */
        background-size: cover;
        color: #ffffff;
      }

      .container {
        width: 400px;
        margin: 100px auto;
        background-color: rgba(0, 0, 0, 0.7);
        /* Semi-transparent black */
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
      }

      .login h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #ffcc00;
        /* Bright yellow for energy */
        font-weight: bold;
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
        padding: 12px;
        border: none;
        border-radius: 6px;
        background-color: #f8f9fa;
        /* Light gray for contrast */
        font-size: 16px;
      }

      input[type="text"]:focus,
      input[type="password"]:focus {
        outline: none;
        background-color: #e0e0e0;
      }

      input[type="submit"] {
        width: 100%;
        background-color: #ff4500;
        /* Bright red-orange for sporty vibe */
        color: #ffffff;
        cursor: pointer;
        border: none;
        height: 45px;
        font-size: 18px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
      }

      input[type="submit"]:hover {
        background-color: #e63900;
        /* Darker shade for hover effect */
      }

      p {
        text-align: center;
        margin-top: 20px;
        color: #ffffff;
      }

      a {
        color: #ffcc00;
        /* Bright yellow to match theme */
        text-decoration: none;
      }

      a:hover {
        color: #ffffff;
        /* Hover effect to white */
        text-decoration: underline;
      }

      .error-msg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #ff3333;
        /* Bright red for error */
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
              <h1>Sport Event Login</h1>
            </div>
            <div class="form-group">
              <input type="text" name="username" placeholder="Enter Username" id="username-email" required>
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Enter Password" id="password" required>
            </div>

            <input type="submit" name="login">
            <p>Don't have an account? <a href="signup.php">Sign up now</a></p>

            <?php
            $conn = new mysqli('localhost', 'root', '', 'sport_event');
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
                header("Location: ../admin/index.php");
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
                background-color: #ff3333;
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