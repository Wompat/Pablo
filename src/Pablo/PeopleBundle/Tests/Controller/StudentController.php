<?php

namespace Pablo\PeopleBundle\Tests\Controller;

use atoum\AtoumBundle\Test\Units\WebTestCase;
use atoum\AtoumBundle\Test\Controller\ControllerTest;

class StudentController extends ControllerTest
{
    public function testListAction()
    {
        $this
            ->request(array('debug' => true))
                ->GET('/student/')
                ->hasStatus(200)
                ->hasCharSet('UTF-8')
                ->hasVersion('1.1')
        ;
    }
}