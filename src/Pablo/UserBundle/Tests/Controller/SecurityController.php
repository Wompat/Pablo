<?php

namespace Pablo\UserBundle\Tests\Controller;

//use atoum\AtoumBundle\Test\Units\WebTestCase;
use atoum\AtoumBundle\Test\Controller\ControllerTest;

class SecurityController extends ControllerTest
{
    public function testLoginAction()
    {
        $this
            ->request(array('debug' => true))
                ->GET('/login')
                    ->hasStatus(200)
                    ->hasCharset('UTF-8')
                    ->hasVersion('1.1')
                    ->hasHeader('Content-Type', 'text/html; charset=UTF-8')
                    ->crawler
                        ->hasElement('div.container')->end()
                        ->hasElement('form.form-signin')
                            ->hasChild('h2.form-signin-heading')->end()
                            ->hasChild('input')->exactly(4)->end()
                            ->hasChild('input[type=text]')->withAttribute('id', 'username')->end()
                            ->hasChild('input[type=password]')->withAttribute('id', 'password')->end()
                            ->hasChild('input[type=checkbox]')->withAttribute('id', 'remember_me')->end()
                            ->hasChild('input[type=submit]')->withAttribute('value', 'Connexion')
                        ->end()
        ;
    }
}