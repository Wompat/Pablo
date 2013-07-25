<?php

namespace Pablo\UserBundle\Tests\Unit;


use Pablo\UserBundle\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User();
        $this->user->setUsername('root');
        $this->user->setPlainPassword('bonjour');
    }

    public function testGetName()
    {
        $actualName = $this->user->getUserName();
        $this->assertEquals('root', $actualName, 'Name should be <root>');
    }

    public function testGetSalt()
    {
        $actualSalt = $this->user->getSalt();
        $this->assertNotNull($actualSalt, 'Salt should not be <null>');
    }

    public function testGetEnabled()
    {
        $actualValue = $this->user->getEnabled();
        $this->assertTrue($actualValue, 'Enabled should be <true>');
    }
}
