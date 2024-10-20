<?php
include "./index.php";
require '../session/session.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background:#fff;
  /* display: flex; */
  align-items: center;
  justify-content: center;
}
/* .container{
  width: 85%;
  background: #fff;
  border-radius: 6px;
  padding: 20px 60px 30px 40px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
} */
.container .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.container .content .left-side{
  width: 25%;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 15px;
  position: relative;
}
.content .left-side::before{
  content: '';
  position: absolute;
  height: 70%;
  width: 2px;
  right: -15px;
  top: 50%;
  transform: translateY(-50%);
  background: #afafb6;
}
.content .left-side .details{
  margin: 14px;
  text-align: center;
}
.content .left-side .details i{
  font-size: 30px;
  color: #3e2093;
  margin-bottom: 10px;
}
.content .left-side .details .topic{
  font-size: 18px;
  font-weight: 500;
}
.content .left-side .details .text-one,
.content .left-side .details .text-two{
  font-size: 14px;
  color: #afafb6;
}
.container .content .right-side{
  width: 75%;
  margin-left: 75px;
}
.content .right-side .topic-text{
  font-size: 23px;
  font-weight: 600;
  color: #3e2093;
}
.right-side .input-box{
  height: 50px;
  width: 100%;
  margin: 12px 0;
}
.right-side .input-box input,
.right-side .input-box textarea{
  height: 100%;
  width: 100%;
  border: none;
  outline: none;
  font-size: 16px;
  background: #F0F1F8;
  border-radius: 6px;
  padding: 0 15px;
  resize: none;
}
.right-side .message-box{
  min-height: 110px;
}
.right-side .input-box textarea{
  padding-top: 6px;
}
.right-side .button{
  display: inline-block;
  margin-top: 12px;
}
.right-side .button input[type="submit"]{
  color: #fff;
  font-size: 18px;
  outline: none;
  border: none;
  padding: 8px 16px;
  border-radius: 6px;
  background: #3e2093;
  cursor: pointer;
  transition: all 0.3s ease;

}
.button input[type="button"]:hover{
  background: #5029bc;
}


@media (max-width: 950px) {
  .container{
    width: 90%;
    padding: 30px 40px 40px 35px ;
  }
  .container .content .right-side{
   width: 75%;
   margin-left: 55px;
}
}
@media (max-width: 820px) {
  .container{
    margin: 40px 0;
    height: 100%;
  }
  .container .content{
    flex-direction: column-reverse;
  }
 .container .content .left-side{
   width: 100%;
   flex-direction: row;
   margin-top: 40px;
   justify-content: center;
   flex-wrap: wrap;
 }
 .container .content .left-side::before{
   display: none;
 }
 .container .content .right-side{
   width: 100%;
   margin-left: 0;
 }
}

.success-box {
            padding: 10px;
            border: 1px solid #008000;
            border-radius: 5px;
            margin: 15px auto;
            width: 400px;
            text-align: center;
            font-size: 16px;
            background-color: #e0ffe0;
            color: #008000;
            display: none;
        }

        .success-message {
            background-color: #e0ffe0;
            color: #008000;
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
        }
     </style>
   </head>
<body>
  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Nairobi, Zetech Ruiru</div>
          <div class="text-two">Along Thika Road</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+2541 2232 3978</div>
          <div class="text-two">+2547 8203 5831</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">julius@zetech.ac.ke</div>
          <div class="text-two">info.julis@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>
        Your feedback is valuable to us. We'd love to hear from you! Share your thoughts, and together, we'll make our services even better. Don't hesitate; your voice matters.</p>
        <form method="post" action="#">
        <div class="input-box">
            <input type="text" name="email" placeholder="Enter your email" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" style="width: 600px;">
        </div>
        <div class="input-box message-box">
            <textarea name="message" placeholder="Enter your message" style="width: 600px;"></textarea>
        </div>
        <div class="button">
            <input type="submit" name="submit" value="Submit">
        </div>
        <?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $host = 'localhost';
    $db = 'julis';
    $user = 'root';
    $pass = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
        $message = isset($_POST['message']) ? $_POST['message'] : null;
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, feedback_text) VALUES (:user_id, :feedback_text)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':feedback_text', $message);
        if ($stmt->execute()) {
            echo "Feedback submitted successfully!";
        } else {
            echo "Error submitting feedback.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
    </form>

    </div>
    </div>
  </div>
  <?php
include "./footer.php";
?>
</body>
</html>