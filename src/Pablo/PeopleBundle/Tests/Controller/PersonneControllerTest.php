<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class PersonneControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
    }

    public function testListAction()
    {
        $crawler = $this->client->request('GET', '/personne');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');

        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Liste des élèves")')->count(), 'Devrait rediriger vers [liste des élèves]');

        if ($crawler->filter('html table')->count() == 0) {
            $this->assertEquals(1, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Devrait afficher 1 [alert alert-info]');
        } else {
            $this->assertEquals(0, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Ne devrait pas afficher [alert alert-info]');
            $this->assertEquals(1, $crawler->filter('div.container table')->count(), 'Devrait afficher [tableau de personnes]');
            $this->assertTrue($crawler->filter('tbody a')->count() >= 1, 'Devrait contenir au moins 1 [lien vers fiche élève]');

            $personLink = $crawler->filter('tbody a')->first();
            $personLastName = $crawler->filter('td')->siblings()->first()->text();
            $personFirstName = $crawler->filter('td')->siblings()->first()->nextAll()->first()->text();

            $crawler = $this->client->click($personLink->link());
            $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche élève")')->count(), 'Devrait rediriger vers [fiche élève]');

            $actualName = $personFirstName . ' ' . $personLastName;
            $this->assertEquals(1, $crawler->filter('dl:contains("' . $actualName . '")')->count(), 'Devrait rediriger vers [fiche élève]');
        }
    }

    private function logIn($username, $credentials, $role)
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'main';
        $token = new UsernamePasswordToken($username, $credentials, $firewall, $role);
        $session->set('_security_'.$firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
}