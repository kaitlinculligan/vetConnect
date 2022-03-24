<?php

    include('APIGateway.php')
    class MessageBroker{
        private $buffer;
        private $gateway
        private $index = 0;

        function __construct(){
            $this->buffer = new array();
            $this->gateway = new APIGateway('url', 'username', 'password');
        }

        function getBuffer(){
            return $this->buffer;
        }

        function addToBuffer($toAdd){
            $this->buffer->array_push($toAdd);
        }

        function sendToAPI(){
            //sends buffer to APIGateway
            $result = $this->gateway->queryDB($index);
            $this->index = $this->index +1;
            return $result;
        }
    }

?>