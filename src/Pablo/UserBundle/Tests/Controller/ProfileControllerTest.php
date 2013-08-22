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
 * Class ProfileControllerTest
 * @package Pablo\UserBundle\Tests\Controller
 */
class ProfileControllerTest extends WebTestCase
{
    /**
     * Client
     */
    private $client = null;

    /**
     * Initialise le client
     * Authentifie l'utilisateur "root"
     */
    public function setUp()
    {
        $this->client = static::createClient();
        $this->logIn();
    }

    /**
     * Teste le formulaire d'édition du profil :
     * 1. Vérifie que le formulaire est affiché.
     * 2. Vérifie que le bouton [annuler] renvoie vers la page d'accueil
     */
    public function testEditAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le formulaire est bien affiché
        // -------------------------------------------------------------------------------------------------------------
        $crawler = $this->client->request('GET', '/profile/edit');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Modifier mon profil")')->count(), 'Devrait rediriger vers [edit profile]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le bouton annuler renvoie vers la page d'accueil.
        // -------------------------------------------------------------------------------------------------------------
        $cancelLink = $crawler->filter('div.form-actions a.btn');
        $username = $crawler->filter('input[type=text]')->first()->attr('value');

        $this->client->request('GET', '/profile/edit');
        $crawler = $this->client->click($cancelLink->link());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bonjour Pablo !")')->count(), 'Devrait rediriger vers [welcome page]');
    }

    /**
     * Teste la mise à jour du profil de l'utilisateur :
     * 1. Vérifie que la redirection vers la page d'accueil
     * 2. Vérifie la présence d'un message flash.
     */
    public function testUpdateAction()
    {
        $crawler = $this->client->request('GET', '/profile/edit');

        $button = $crawler->selectButton('valider');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le profil a été modifié
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            'pablo_userbundle_profiletype[username]' => 'root',
            'pablo_userbundle_profiletype[plainPassword][first]' => 'bonjour',
            'pablo_userbundle_profiletype[plainPassword][second]' => 'bonjour',
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bonjour Pablo !")')->count(), 'Devrait rediriger vers [welcome page]');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("Le profil a été modifié.")')->count(), 'Devrait afficher [profil modifié]');
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