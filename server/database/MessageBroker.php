<?php
    class MessageBroker{
        private $buffer;

        function __construct(){
            $this->buffer = new array();
        }

        function getBuffer(){
            return $this->buffer;
        }

        function addToBuffer($toAdd){
            $this->buffer->array_push($toAdd);
        }

        function sendToAPI(){
            //sends buffer to APIGateway
        }
    }

?>