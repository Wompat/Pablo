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
        $this->logIn();
    }

    public function testListAction()
    {
        $crawler = $this->client->request('GET', '/personne');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Header status should be <200>');

        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Liste des élèves")')->count(), 'Devrait rediriger vers <liste des élèves>');

        if ($crawler->filter('html table')->count() == 0) {
            $this->assertEquals(1, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Devrait afficher 1 <alert alert-info>');
        } else {
            $this->assertEquals(0, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Ne devrait afficher aucune <alert alert-info>');
            $this->assertEquals(1, $crawler->filter('div.container table')->count(), 'Devrait afficher <tableau de personnes>');
            $this->assertTrue($crawler->filter('tbody a')->count() >= 1, 'Devrait contenir au moins 1 <lien vers fiche élève>');

            $personLink = $crawler->filter('tbody a')->first();
            $personLastName = $crawler->filter('td')->siblings()->first()->text();
            $personFirstName = $crawler->filter('td')->siblings()->first()->nextAll()->first()->text();

            $crawler = $this->client->click($personLink->link());
            $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche élève")')->count(), 'Devrait rediriger vers <fiche élève>');

            $actualName = $crawler->filter('div.well-small h4')->text();
            $this->assertEquals($actualName, $personFirstName . ' ' . $personLastName, 'Devrait rediriger vers <fiche élève sélectionné>');
        }
    }

    private  function logIn()
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
