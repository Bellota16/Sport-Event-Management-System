<?php
include "index.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn{
            margin-top: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }
        /* button{
            background-color: black;
            color: white;
            border-radius: 50px;
            outline: none;
            font-size: 18px;
            font-weight: bold;
            width: 200px;
            height: 40px;
            transition: transform 0.3s, background-color 0.3s;
        }
        .button:hover {
            background-color: #00ccff;
            transform: scale(1.1);
        } */
    </style>
</head>
<body>
    <div class="btn">
        <button class="button" onclick="redirectToFootball()">Football</button>
        <button class="button" onclick="redirectToVolleyball()">Volleyball</button>
        <button class="button" onclick="redirectToCricket()">Cricket</button>
    </div>
    <script>
function redirectToFootball() {
    window.location.href = "football.php";
}
</script>
<script>
function redirectToVolleyball() {
    window.location.href = "volleyball.php";
}
</script>
<script>
function redirectToCricket() {
    window.location.href = "cricket.php";
}
</script>
</body>
</html>