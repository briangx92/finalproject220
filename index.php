<?php
include_once 'db.php';
?>

<html>
<link rel="stylesheet" type="text/css" href="datastyle.css">
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
    <input type="button" onclick="location.href='register.php';" value="register">

</form>
<body>
</body>
</html>
