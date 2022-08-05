<?php


class Users extends Database {
    public $name;
    public $gender;
    public $age;
    public $status;
    public $table = "user";
    public $result;

    public function userInfo($conditions = "",$field = "*", $column ="") {
       return $this->lookUp($this->table,$field,$conditions,$column);
    } 
    
    public function countUserRows($conditions) {
      return $this->countRows($this->table,"*",$conditions);
    }
    
    public function isExists($conditions) {
      $rlt = $this->countUserRows($conditions);
      if($rlt > 0){
        return true;
      }else{
        return false;
      }
    }
    
     public function singleUserInfo($userId) {
         $this->result = $this->userInfo("id = '$userId'");
         $this->name = $this->result['name'];
         $this->gender = $this->result['gender'];
         $this->age = $this->result['age'];
         $this->status = $this->result['status'];
      }

    public function editSingleUserInfo($userId) {
      return $this->singleUserInfo($userId);
    }

    public function userResult($userId) {
      $this->singleUserInfo($userId);
      return $this->result;

    }
     public function userName($userId) {
         $this->singleUserInfo($userId);
         return $this->name;
      }
      
      public function userGender($userId) {
         $this->singleUserInfo($userId);
         return $this->gender;
      }
      
      public function userAge($userId) {
         $this->singleUserInfo($userId);
         return $this->age;
      }
      
      public function userStatus($userId) {
         $this->singleUserInfo($userId);
          return $this->status == 0 ? "Active" : "Deleted";
      }
      
      public function getUsersByStatus($status) {
        return $this->userInfo("status = '$status'"); 
     }

     public function getDeletedUsers() {
       return $this->getUsersByStatus(1);
     }

     public function getActiveUsers() {
       return $this->getUsersByStatus(0); 
     }

     public function validateUser(){
        if(Fun::checkEmptyInput([$this->name,$this->age,$this->gender])){
            Fun::reDirect("../views/user.php", "msg", "None of the fields must be empty");
           exit;
        }

        if(is_numeric($this->name)){
            Fun::reDirect("../views/user.php", "msg","Name must be in text only");
            exit;
    
        }
       
       if(!is_numeric($this->age)){
          Fun::reDirect("../views/user.php", "msg", "Age must be in number only");
          exit;

       }
       
       if($this->isExists("name = '$this->name'")){
          Fun::reDirect("../views/user.php", "msg", "This name already exists");
          exit;

    }
    
    }

     public function processUser($name,$gender,$age){
        $this->name = $this->escape($name);
        $this->gender = $this->escape($gender);
        $this->age = $this->escape($age);
        $this->validateUser();

        $this->saveUser();
     }

     public function saveUser(){
       $this->save($this->table, "name = '$this->name', gender = '$this->gender', age = '$this->age'");
     }
 }