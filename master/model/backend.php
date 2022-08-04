<?php
 
require("../model/db/db.php");
require("../classes/commonFunction/commonFunction.php");

$db = new Database(); 

$name = $db->escape($_POST['name']);
$carType = $db->escape($_POST['type']);
$carColor = $db->escape($_POST['color']);



if (Fun::checkEmptyInput([$name,$carColor,$carType])) {
    Fun::reDirect("../views/user.php?msg=None of the fields must be empty");
}

    $db->save("user", "name= '$name', type= '$carType', color= '$carColor' ");
 

