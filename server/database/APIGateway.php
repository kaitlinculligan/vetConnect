<?php 
    class APIGateway{
        private $DBURL;
        private $username;
        private $password;
        private $dbConnect;
        public $result;

        function __construct($DBURL, $username, $password){
            $this->DBURL = $DBURL;
            $this->username = $username;
            $this->password = $password;
        }

        function connectToDB(){
            $this->dbConnect = new mysqli($this->DBURL, $this->username, $this->password);
            if($this->dbConnect->connect_error){
                die("Connection failed: " .$dbConnect->connect_error);
            }
        }

        function queryDB($q){
            $result = $this->$dbConnect->query($q);
            $result = convertResponse($result);
            return $result;
        }

        function convertResponse($input){
            //this will parse the input from the database 
            //it may not actually be necessary
        }

        function closeConnection(){
            $dbConnect->close();
        }
    }

?>