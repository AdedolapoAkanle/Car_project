<?php

class Users extends Database {
    public $name;
    public $gender;
    public $age;
    public $status;
    public $table = "user";

    public function userInfo($conditions = "",$field = "*", $column ="") {
       return $this->lookUp($this->table,$field,$conditions,$column);
    } 
    
    public function countUserRows($conditions) {
      return $this->countRows($this->table,"",$conditions);
    }
    
    public function isExists($condition) {
      $rlt = $this->countUserRows($condition);
      if($rlt > 0){
        return true;
      }else{
        return false;
      }
    }
    
     public function singleUserInfo($userId) {
         $rlt = $this->userInfo("id = '$userId'");
         $this->name = $rlt['name'];
         $this->gender = $rlt['gender'];
         $this->age = $rlt['age'];
         $this->status = $rlt['status'];
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
        if(Fun::checkEmptyInput($this->name,$this->age,$this->gender)){
            return "None of the fields must be empty";
        }

        if(is_numeric($this->name)){
            return "Name must be in text only";
       }

       if($this->isExists("name = '$this->name'")){
        return "This name already exists";
       }
       
       if(!is_numeric($this->age)){
        return "Age must be in number only";
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