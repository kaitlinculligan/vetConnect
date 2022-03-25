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
            //parse query for database
            $table;
            if(strpos($q, "Client")!=FALSE){
                $table = "Client";
            }

            if(strpos($q, "Admin")!=FALSE){
                $table = "Admin";
            }

            if(strpos($q, "Vet")!=FALSE){
                $table = "Vet";
            }

            if(strpos($q, "time_availability")!=FALSE){
                $table = "time_availability";
            }

            if(strpos($q, "Appointment")!=FALSE){
                $table = "Appointment";
            }

            if(strpos($q, "Pets")!=FALSE){
                $table = "Pets";
            }

            $result = $this->$dbConnect->query($q);
            $result = convertResponse($result, $table);
            return $result;
        }

        //parse result according to query
        function convertResponse($input, $database){
            $string = '';
            if($database == "Client"){
                while($row = $input->fetch_assoc()){
                    
                }
            }

            if($database == "Admin"){
                while($row = $input->fetch_assoc()){

                }
            }

            if($database == "Vet"){
                while($row = $input->fetch_assoc()){

                }
            }

            if($database == "time_availability"){
                while($row = $input->fetch_assoc()){

                }
            }

            if($database == "Appointment"){
                while($row = $input->fetch_assoc()){

                }
            }

            if($database == "Pets"){
                while($row = $input->fetch_assoc()){

                }
            }
            
            //this will parse the input from the database 
            //it may not actually be necessary
        }

        function closeConnection(){
            $dbConnect->close();
        }
    }

?>