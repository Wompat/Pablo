<?php

namespace Pablo\PeopleBundle\Tests\Units\Entity;

use atoum\AtoumBundle\Test\Units;
use mageekguy\atoum\asserters\string;

class Student extends Units\Test
{
    public function test__toString()
    {
        $this
            ->if($student = new \Pablo\PeopleBundle\Entity\Student())
            ->and($student->setLastName('Crashtest'))
            ->and($student->setFirstName('Dummy'))
            ->then
                ->string($student->__toString())
                    ->isEqualTo('Crashtest Dummy')
                    ->isNotEqualTo('Batman')
        ;
    }

    public function testGetLastName()
    {
        $this
            ->if($student = new \Pablo\PeopleBundle\Entity\Student())
            ->and($student->setLastName('Crashtest'))
            ->then
                ->string($student->getLastName())
                    ->isEqualTo('Crashtest')
                    ->isNotEqualTo('Batman')
        ;
    }

    public function testGetFirtsName()
    {
        $this
            ->if($student = new \Pablo\PeopleBundle\Entity\Student())
            ->and($student->setFirstName('Dummy'))
            ->then
                ->string($student->getFirstName())
                ->isEqualTo('Dummy')
                ->isNotEqualTo('Batman')
        ;
    }

    public function testGetSex()
    {
        $this
            ->if($student = new \Pablo\PeopleBundle\Entity\Student())
            ->then
                ->string($student->getSex())
                ->isEqualTo('F')
                ->isNotEqualTo('M')
        ;
    }

    public function testGetDateOfBirth()
    {
        $this
            ->if($student = new \Pablo\PeopleBundle\Entity\Student())
            ->and($student->setDateOfBirth(new \DateTime('1977-02-09')))
            ->then
                ->dateTime($student->getDateOfBirth())
                    ->hasDate('1977', '02', '09')
                    ->hasDate('1977', '2', '9')
                    ->hasDate(1977, 2 , 9)
        ;
    }
}