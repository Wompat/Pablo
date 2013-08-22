<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class SecurityControllerTest
 * @package Pablo\UserBundle\Tests\Controller
 */
class SecurityControllerTest extends WebTestCase
{
    /**
     * Client
     */
    private $client = null;

    /**
     * Initialise le client
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Teste le formulaire d'authentification :
     * 1. Redirection vers le formulaire
     * 2. Affichage d'un message d'erreur en cas d'échec de l'authentification
     * 3. Redirection vers la page d'accueil en cas d'authentification réussie
     */
    public function testLoginAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est redirigé vers le formulaire de connexion.
        // -------------------------------------------------------------------------------------------------------------
        $this->client->request('GET', '/');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('h2.form-signin-heading:contains("Pablo !")')->count(), 'Devrait afficher [login form]');

        $button = $crawler->selectButton('Connexion');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'un message d'erreur est affiché quand l'authentification échoue.
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            '_username' => 'root',
            '_password' => 'bonsoir'
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.alert-error:contains("Bad credentials")')->count(), 'Devrait être affiché [Bad credentials].');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est redirigé vers la page d'accueil après s'être authentifié.
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            '_username' => 'root',
            '_password' => 'bonjour',
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bonjour Pablo !")')->count(), 'Devrait rediriger vers [welcome page]');
    }

    /**
     * Teste la déconnexion de l'utilisateur et la redirection vers le formulaire d'authentification.
     */
    public function testLogoutAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est redirigé vers le formulaire de connexion.
        // -------------------------------------------------------------------------------------------------------------
        $this->client->request('GET', '/logout');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('h2.form-signin-heading:contains("Pablo !")')->count(), 'Devrait rediriger vers [login form]');
    }
}