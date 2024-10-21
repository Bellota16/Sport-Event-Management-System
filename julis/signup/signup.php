<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
  <link rel="icon" type="image/png" href="../images/image.png"/>
  <script src="insert.js"></script> 
  <style>
     body {
      font-family: Arial, sans-serif;
      background-image: url('picture2.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .container {
      width: 400px;
      margin: 30px auto;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 50px;
      color: #ffffff; /* Set color for h2 */
    }

    form {
      width: 100%;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    label {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 6px;
      background-color: #f1f1f1;
      margin-bottom: 10px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
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
      color: #ff0000;
      text-decoration: none;
    }
    #gender {
      margin-top: 5px;
      margin-bottom: 10px;
    }

    #gender label {
      margin-right: 10px;
    }
  </style>
</head> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #000; /* Set page background to black */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
    width: 400px;
    margin: 100px auto;
    background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: calc(100% - 20px);
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    label {
      margin-right: 15px;
      font-size: 14px;
      color: #555;
    }

    #gender {
      margin: 15px 0;
    }

    input[type="submit"] {
      width: 100%;
      background-color: #007BFF;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 15px;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    p {
      text-align: center;
      margin-top: 15px;
      color: #555;
    }

    p a {
      text-decoration: none;
      color: #007BFF;
    }

    p a:hover {
      text-decoration:  underline;
    }
  </style>
</head>
<body> 
  <div class="container">
    <form action="connect.php" method="post">
     <h2 class="header-line" style="padding-bottom: 1px; font-weight: bold; color: white;">Create an Account</h2> 
      
      <div id="names">
        <input type="text" placeholder="Username" name="username" required id="name"/> 
      </div>

      <input type="email" name="email" placeholder="Email" id="email" required />

      <div id="gender">
        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="m" required>
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="f" required>
      </div>

      <div id="password">
        <input type="password" name="password" placeholder="Password" required />   
        <input type="password" name="confirm_password" placeholder="Confirm Password" required /> 
      </div>
      
      <br> 
      <input type="submit" value="Sign Up" /> 
      <p>Already have an account? <a href="./login.php">Login</a></p>
    </form> 
  </div>
  <script src="insert.js"></script>
</body>
</html>

