<?php
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];

    $conn = new mysqli('localhost','root','','julis');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die("Connection Failed : ". $conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $error = "Email address already exists. Please use a different email address.";
            echo '<script>alert("' . $error . '"); window.location.href="./signup.php";</script>';
            exit();
        } else {
            // Check if password and confirm password match
            if ($password !== $confirmpassword) {
                $error = "Passwords do not match. Please try again.";
                echo '<script>alert("' . $error . '"); window.location.href="./signup.php";</script>';
                exit();
            } else {
                $stmt = $conn->prepare("INSERT INTO users (username, gender, email, password, confirm_password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $username, $gender, $email, $password, $confirmpassword);
                $execval = $stmt->execute();
                if($execval){
                    echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
                    exit();
                } else {
                    echo '<script>alert("Error: ' . $conn->error . '"); window.location.href="/signup.php";</script>';
                    exit();
                }
                $stmt->close();
            }
        }
        $conn->close();
    }
?>
