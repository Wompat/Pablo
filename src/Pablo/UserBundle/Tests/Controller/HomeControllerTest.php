<?php

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

class HomeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->logIn();
    }

    public function testWelcome()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bienvenue !")')->count(), 'Devrait rediriger vers <welcome page>');
        $this->assertEquals(1, $crawler->filter('h3.media-heading:contains("Mon profil")')->count(), 'Devrait contenir <Mon profil>');

        // Vérifie que le lien renvoie bien vers le formulaire d'éditon du profil et que le champ nom d'utilisateur est rempli.
        $profileLink = $crawler->filter('a.btn-info')->first();
        $username = $crawler->filter('p strong')->text();

        $crawler = $this->client->click($profileLink->link());
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Modifier mon profil")')->count(), 'Devrait rediriger vers <edit profile>');
        $this->assertEquals(1, $crawler->filter('input[value=' . $username . ']')->count(), 'Le champ nom d\'utilisateur devrait contenir <' . $username . '>');
    }

    private function logIn()
    {
        $crawler = $this->client->request('GET', '/login');

        $button = $crawler->selectButton('Connexion');
        $form = $button->form();

        $this->client->submit($form, array(
            '_username' => 'root',
            '_password' => 'bonjour',
        ));
    }
}