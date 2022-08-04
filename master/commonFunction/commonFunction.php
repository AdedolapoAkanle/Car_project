<?php 


class Fun {

    public static function arrayPrinter($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";

    } 

    public static function reDirect($url) {
        header("Location:$url");
    } 


    public static function checkEmptyInput($params=[]) {
        for ($i=0; $i < sizeof($params); $i++) { 
            if (isset($params[$i]) || empty($params[$i])) {
                return true;
            }
        }
        return false;
    } 


}
 

?>