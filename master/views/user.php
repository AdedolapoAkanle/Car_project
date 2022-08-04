<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if(isset($_GET['msg'])) echo $_GET['msg']; ?>
    <form method="Post" action="../model/backend.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php $name; ?>"><br>
        <label for="type">Gender:</label><br>
        <input type="text" id="gender" name="gender" value="<?php $gender; ?>"><br>
        <label for="color">Age:</label><br>
        <input type="text" id="age" name="age" value="<?php $age; ?>"><br>
        <input type="submit" name="submit">
    </form>

</body>
<table>
    <?php
require("../model/db/db.php");
require("../classes/Users/Users.php");
$usr = new Users(); 
$rlt = $usr->userInfo(); 
if(!empty($rlt)){
    foreach ($rlt as  $row) {  

    echo" <tr>
            <td>{$row['name']} </td>
            <td>{$row['gender']}</td>
            <td>{$row['age']}</td>
        </tr>";
    } 
}
?>
</table>

</html>