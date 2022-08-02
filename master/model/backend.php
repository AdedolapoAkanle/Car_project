<?php

require("../views/user.php");
require("../model/db/db.php");

$name = $_POST['name'];
$carType = $_POST['type'];
$carColor = $_POST['color'];


$user = new Database();

$name = $user->escape($name);
$carType = $user->escape($carType);
$carColor = $user->escape($carColor);

if ($name != '' && $carColor != '' && $carType != '') {
    $user->save("user", "name= '$name', type= '$carType', color= '$carColor' ");
   
  
}
$us = $user->lookUp("user", "*");
echo $us;