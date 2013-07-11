<?php

namespace Pablo\UserBundle\Tests\Units\Entity;

use atoum\AtoumBundle\Test\Units;

class User extends Units\Test
{
    public function testGetId()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->then
                ->variable($user->getId())
                    ->isNull()
        ;
    }

    public function testGetUsername()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->and($user->setUsername('root'))
            ->then
                ->string($user->getUsername())
                    ->isEqualTo('root')
                    ->isNotEqualTo('sheldon')
        ;
    }

    public function testGetPlainPassword()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->and($user->setPlainPassword('bonjour'))
            ->then
                ->string($user->getPlainPassword())
                    ->isEqualTo('bonjour')
                    ->isNotEqualTo('sheldon')
        ;
    }

    public function testEraseCredentials()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->and($user->setPlainPassword('bonjour'))
            ->and($user->eraseCredentials())
            ->then
                ->variable($user->getPlainPassword())
                    ->isNull()
        ;
    }

    public function testGetTeacher()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->and($teacher = new \Pablo\PeopleBundle\Entity\Teacher())
            ->and($user->setTeacher($teacher))
            ->then
                ->object($user->getTeacher())
                    ->isInstanceOf('\Pablo\PeopleBundle\Entity\Teacher')
        ;
    }
}