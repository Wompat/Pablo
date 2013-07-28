<?php

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class HomeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testWelcome()
    {
        $this->logIn();
        $this->client->followRedirects();

        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Header status should be <200>');

        $this->assertTrue($crawler->filter('div.page-header h2:contains("Bienvenue !")')->count() > 0, 'Should be redirected to the <welcome page>');
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'main';
        $token = new UsernamePasswordToken('root', $firewall, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}