<?php
    namespace UnitTestFiles\Test;
    use PHPUnit\Framework\TestCase;
    class MessageBrokerTest extends TestCase{
        
        function testAddToBuffer(){
            $broker = new MessageBroker();
            $broker->addToBuffer('test');
            $result = $broker->getBuffer();
            $this->assertSame('test', $result[0]);
        }

        function testSendToAPI(){
            //need to figure out how to test this
        }

    }
?>