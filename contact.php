<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>welcome to my form</h1>
    <form action="sendmail.php" method="POST" enctype="multipart/form-data">
        <input type="text" id="name" placeholder="name" name="name" required><br><br>
        <input type="number" id="age" placeholder="age" name="age" required><br><br>
        <input type="email" id="email" placeholder="email" name="email" required><br><br>
        <input type="text" id="message" placeholder="message" name="message" required><br><br>
        <input type="file" id="cv" name="cv" required><br><br>
        <button type="submit" name="submit">Send Mail</button>
    </form>
</body>

</html>