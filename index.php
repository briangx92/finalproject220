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
    <input type="submit">
</form>
<body>
</body>
</html>
