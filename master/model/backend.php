<?php
 
require("../model/db/db.php");
require("../commonFunction/commonFunction.php");
require("../classes/Users/Users.php");
 

$usr = new Users();

$usr->processUser($_POST['name'],$_POST['gender'],$_POST['age']);
if($usr) {
    Fun::reDirect("../views/user.php", "msg", "");
}