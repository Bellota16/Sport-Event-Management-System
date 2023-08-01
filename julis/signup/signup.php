<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
  <link rel="icon" type="image/png" href="../images\image.png"/>
  <script src="insert.js"></script> 
  <style>
     body {
      font-family: Arial, sans-serif;
      background-color: #e8f4f8;
    }

    .container {
      width: 400px;
      margin: 30px auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333333;
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
    #gender{
  margin-top: 5px;
margin-bottom: 10px;   
 }
  </style>
  <head> 
    
    </head> 
    <body> 
      
        <div class="container">
      <form action="connect.php" method="post">
        <h2>Create an Account</h2> 
        <div id="names">
          <input type="text" placeholder="Username" name="username" required id="name"/> 
        </div>

        <input type="email" name="email" placeholder="Email" name="email" id="email" required />

          <div id="gender">
          <label for="">Gender</label>
          <label for="male">Male<input type="radio" name="gender" id="male" value="m"></label>
          <label for="female">Female<input type="radio" name="gender" id="female" value="f"></label>
        </div>

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