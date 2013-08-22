<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;

/**
 * Class HomeControllerTest
 * @package Pablo\UserBundle\Tests\Controller
 */
class HomeControllerTest extends WebTestCase
{
    /**
     * Client
     */
    private $client = null;

    /**
     * Initialise le client et le configure pour suivre toutes les redirections
     * Authentifie l'utilisateur "root"
     */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
        $this->logIn();
    }

    /**
     * Teste la la page d'accueil
     * Vérifie que le lien "Mon profil" redirige vers le formulaire d'édition du profil
     * Vérifie que le champ nom d'utilisateur est correctement rempli par défaut.
     */
    public function testWelcome()
    {
        $crawler = $this->client->request('GET', '/');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bonjour Pablo !")')->count(), 'Devrait rediriger vers [welcome page]');
        $this->assertEquals(1, $crawler->filter('h4.media-heading:contains("Mon profil")')->count(), 'Devrait contenir [Mon profil]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le lien renvoie vers le formulaire d'édition du profil.
        // Vérifie que le champ nom d'utilisateur est rempli par défaut.
        // -------------------------------------------------------------------------------------------------------------
        $profileLink = $crawler->filter('div.media a')->first();
        $username = 'root';

        $crawler = $this->client->click($profileLink->link());
        $actualHeader = $crawler->filter('div.page-header h2')->text();
        $this->assertEquals('Modifier mon profil', $actualHeader);
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Modifier mon profil")')->count(), 'Devrait rediriger vers [edit profile]');
        $this->assertEquals(1, $crawler->filter('input[value=' . $username . ']')->count(), 'Le champ nom d\'utilisateur devrait contenir [' . $username . ']');
    }

    /**
     * Authentifie l'utilisateur "root".
     */
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