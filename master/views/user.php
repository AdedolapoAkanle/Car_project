
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
        <label for="name">Car name:</label><br>
        <input type="text" id="name" name="name" value="<?php $name; ?>"><br>
        <label for="type">Car Type:</label><br>
        <input type="text" id="type" name="type" value="<?php $carType; ?>"><br>
        <label for="color">Car color:</label><br>
        <input type="text" id="color" name="color" value="<?php $carColor; ?>"><br>
        <input type="submit" name="submit">
    </form>
   
</body>
<table>
<?php
require("../model/db/db.php");
$db = new Database(); 
$rlt = $db->lookUp("user"); 
if(!empty($rlt)){
    foreach ($rlt as  $row) {  

    echo" <tr>
            <td>{$row['name']} </td>
            <td>{$row['type']}</td>
            <td>{$row['color']}</td>
        </tr>";
    } 
}
?>
</table>
</html>