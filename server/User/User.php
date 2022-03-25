<?php
    class User{
        private $type;
        private $username;
        private $password;
        private $address;
        private $id;

        function __construct($type, $username, $password, $address, $id){
            $this->type = $type;
            $this->username = $username;
            $this->password = $password;
            $this->address = $address;
            $this->id = $id;
        }

        function getType(){
            return $this->type;
        }

        function setType($type){
            $this->type = $type;
        }

        function getUsername(){
            return $this->username;
        }

        function setUsername($username){
            $this->username = $username;
        }

        function getPassword(){
            return $this->password;
        }

        function setPassword($password){
            $this->password = $password;
        }

        function getAddress(){
            return $this->address;
        }

        function setAddress($address){
            $this->address = $address;
        }

        function getID(){
            return $this->id;
        }

        function setID($ID){
            $this->id = $id;
        }
    }
?>