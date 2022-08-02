<?php 
class Database {

    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $databaseName = 'car_project';
    
    private $con = false;
    private $myConn = '';
    private $result = []; 
    private $myQuery = ""; 
    private $numResults = ""; 
 
    // constructor
    function __construct() {
        $this->myConn = new mysqli($this->host, $this->user, $this->password, $this->databaseName);

        if ($this->myConn->connect_errno) {
            die("Database connection Failed" . $this->myConn->connect_errno);
            $this->con = false;
        }else{ 
            $this->con = true;
        }
    } 

    public function sql($sql) {
        $this->myQuery = $sql; 
        $result = $this->myConn->query($sql); 
        $this->numResults = $this->myConn->num_rows; 
        if(!$result) {
            die("Query failed" . $this->myConn->error);
        }  

        return $result;
    }

    public function escape($string) {
        return strtolower(trim(addslashes(mysqli_real_escape_string($this->myConn,$string))));
    }

    public function getSql() {
        $val = $this->myQuery;
        $this->myQuery = array();
        echo $val;
    }

    public function getResult() {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    public function getNumberOfRows() {
        $val = $this->numResults;
        $this->numResults = array();
        return $val;
    }

    // public function escape($data) {
    //     return strtolower(trim(addslashes($this->myConn->real_escape_string($data))));
    // }

    public function countRows($table, $field ="*", $condition) { 

        $this->sql("SELECT $field FROM $table WHERE $condition");
        return $this->getNumberOfRows();
    }
    
    // these are the CRUD methods
    public function save($table, $sql) {

        return $this->sql("INSERT INTO $table SET $sql");
    }
    
    public function saveChanges($table, $sql,$condition){ 
        return $this->sql("UPDATE $table SET $sql WHERE $condition");
    }
    
    public function erase($table, $condition){
        return $this->sql("DELETE FROM $table WHERE $condition");
    }
    
    public function lookUp($table, $field ="*", $condition = "", $column = ""){
        $con = !empty($condition) ? " WHERE $condition" : "";
        $this->sql("SELECT $field FROM $table $con");
        $rlt = $this->getResult();

        if(!empty($rlt)) {

            if(is_object($rlt) || is_array($rlt)) {

                if(!empty($column)) {

                    if(!empty($rlt[0][$column])) {

                        return $rlt[0][$column];
                    }
                } else {

                    return $rlt;
                }
            }
       }
    }
     
     
 
}



?>