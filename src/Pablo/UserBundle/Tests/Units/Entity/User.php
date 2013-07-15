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

    public function testGetSalt()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->then
                ->string($user->getSalt())
                    ->hasLengthGreaterThan(30)
                    ->hasLengthLessThan(40)
        ;
    }

    public function testGetEnabled()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->then
                ->boolean($user->getEnabled())
                ->isTrue()
            ->if($user->setEnabled(false))
            ->then
                ->boolean($user->getEnabled())
                ->isFalse()
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

    public function testIsEnabled()
    {
        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->then
                ->boolean($user->isEnabled())
                    ->isTrue
            ->if($user->setEnabled(false))
            ->then
                ->boolean($user->isEnabled())
                    ->isFalse()
        ;
    }

    public function testGetRoles()
    {
        $groupMock = new \mock\Pablo\UserBundle\Entity\Group;

        $this
            ->if($user = new \Pablo\UserBundle\Entity\User())
            ->then
                ->array($user->getRoles())
                    ->strictlyContainsValues(array('ROLE_USER'))
            ->if($user->addGroup($groupMock))
            ->then
                ->array($user->getRoles())
                    ->strictlyContainsValues(array($groupMock))
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
}