<?php
    namespace UnitTestFiles\Test;
    use PHPUnit\Framework\TestCase;
    class UserTest extends TestCase{

        public function testTypeGetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);

            $this->assertSame('vet', $user->getType());
        }

        /**
         *  @depends UserTest::testTypeGetter
         */
        public function testTypeSetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);
            $user->setType('client')
            $this->assertSame('client', $user->getType());
        }

        public function testUsernameGetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);

            $this->assertSame('johndoe', $user->getUsername());
        }

        /**
         *  @depends UserTest::testUsernameGetter
         */
        public function testUsernameSetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);
            $user->setUsername('janedoe')
            $this->assertSame('janedoe', $user->getUsername());
        }

        public function testPasswordGetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);

            $this->assertSame('password', $user->getPassword());
        }

        /**
         *  @depends UserTest::testPasswordGetter
         */
        public function testPasswordSetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);
            $user->setPassword('notpassword')
            $this->assertSame('notpassword', $user->getPassword());
        }

        public function testAddressGetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);

            $this->assertSame('123 main street', $user->getAddress());
        }

        /**
         *  @depends UserTest::testAddressGetter
         */
        public function testTypeSetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);
            $user->setAddress('456 main street')
            $this->assertSame('456 main street', $user->getAddress());
        }

        public function testIDGetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);

            $this->assertSame(12345, $user->getID());
        }

        /**
         *  @depends UserTest::testIDGetter
         */
        public function testIDSetter(){
            $user = new User('vet', 'johndoe', 'password', '123 main street', 12345);
            $user->setID(6789)
            $this->assertSame(6789, $user->getID());
        }
    }
?>