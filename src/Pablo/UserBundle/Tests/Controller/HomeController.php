<?php

namespace Pablo\UserBundle\Tests\Controller;

use atoum\AtoumBundle\Test\Controller\ControllerTest;

class HomeController extends ControllerTest
{
    public function testIndexAction()
    {
        $this
            ->request(array('debug', true))
                ->GET('/')
                ->hasStatus(200)
                ->hasCharset('UTF-8')
                ->hasVersion('1.1')
                ->hasHeader('Content-Type', 'text/html; charset=UTF-8')
                ->crawler
                    ->hasElement('div.navbar')
                        ->hasChild('a.brand')->withAttribute('href', '/')->end()
                        ->hasChild('a')->withAttribute('href', '/student/')->end()
                        ->hasChild('a')->withAttribute('href', '/teacher/')->end()
                        ->hasChild('a')->withAttribute('href', '/logout')->end()
                    ->end()
                    ->hasElement('div.page-header')
                        ->hasChild('h2')->withContent('Bienvenue !')->end()
                    ->end()
        ;
    }
}