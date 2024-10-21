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
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
      margin-top: 90px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: white;
      font-weight: bold;
    }

    form {
      width: 100%;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    label {
      width: 94%;
      padding: 12px;
      border: none;
      border-radius: 6px;
      background-color: #f8f9fa;
      margin-bottom: 10px;
      margin-top: -5px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
      outline: none;
      background-color: #e0e0e0;
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
        color: #ffffff;
      }

    a {
      color: #ff0000;
      text-decoration: none;
      font-size: larger;
    }
    a:hover {
        color: #ffffff;
        /* Hover effect to white */
        text-decoration: underline;
      }
    #gender{
      margin-top: 5px;
      margin-bottom: 10px;
      color: gray;  
    }
  </style>
</head> 
<body> 
    <div class="container">
      <form action="connect.php" method="post">
        <h1>Create an Account</h1> 
        <div id="names">
          <input type="text" placeholder="Username" name="username" required id="name"/> 
        </div>

        <input type="email" name="email" placeholder="Email" id="email" required />

        <div id="gender">
          <label for="">Gender</label>
          <label for="male">Male<input type="radio" name="gender" id="male" value="m"></label>
          <label for="female">Female<input type="radio" name="gender" id="female" value="f"></label>
        </div>
        <br>
        <div id="password">
          <input type="password" name="password" placeholder="Password" required />   
          <input type="password" name="confirm_password" placeholder="Confirm Password" required /> 
        <br> 
        <input type="submit" value="Sign Up" /> 
        <p>Already have an account? <a href="./login.php" style="color:red;">Login</a></p>
      </form> 
    </div>
    <script src="insert.js"></script>
</body>
</html>
