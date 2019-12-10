<?php
include_once 'db.php';
securitygate($conn);
?>
<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Supervisor Home - Old Home</title>
</head>
<body>
        <main>
            <table>

                <tr>
                    <th>Name</th>
                    <th>Morning Medicine</th>
                    <th>Afternoon Medicine</th>
                    <th>Night Medicine</th>
                    <th>Breakfast</th>
                    <th>Lunch</th>
                    <th>Dinner</th>
                </tr>
                <tr>


                </tr>


            </table>
            <form>
            <button type="submit" name="submit" value="submit">Submit</button>
            <input type="button" onclick="location.href='index.php';" value="Cancel">
            </form>

        </main>
        <footer>

        </footer>


</body>
</html>

<?php


?>
