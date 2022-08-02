<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $carType = $_POST['type'];
    $carColor = $_POST['color'];
} else {
    $name = "";
    $carType = "";
    $carColor = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="Post" action="../model/backend.php">
        <label for="name">Car name:</label><br>
        <input type="text" id="name" name="name" value="<?php $name; ?>"><br>
        <label for="type">Car Type:</label><br>
        <input type="text" id="type" name="type" value="<?php $carType; ?>"><br>
        <label for="color">Car color:</label><br>
        <input type="text" id="color" name="color" value="<?php $carColor; ?>"><br>
        <input type="submit" name="submit">
    </form>
   
</body>

</html>