<?php
include_once 'db.php';
session_destroy();
echo $_SESSION['message'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <form action="verify.php" method="post">
        <label> Email:
            <input type="email" name="email">
        </label>
        <label> Password:
            <input type="password" name="password">
        </label>
        <br>
        <button type="submit" name="submit" value="submit">Ok</button>
        <input type="button" onclick="location.href='index.php';" value="Cancel">
        <input type="button" onclick="location.href='register.php';" value="Register">

    </form>
    <footer>

    </footer>
</body>

</html>
