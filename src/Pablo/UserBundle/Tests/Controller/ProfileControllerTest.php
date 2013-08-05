<?php

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->logIn();
    }

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
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bienvenue !")')->count(), 'Devrait rediriger vers [welcome page]');
        $this->assertEquals($username, $crawler->filter('p strong')->text(), 'Le nom d\'utilisateur devrait être [' . $username . ']');
    }

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
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Bienvenue !")')->count(), 'Devrait rediriger vers [welcome page]');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("Le profil a été modifié.")')->count(), 'Devrait afficher [profil modifié]');
        $this->assertEquals('root', $crawler->filter('p strong')->text(), 'Le nom d\'utilisateur devrait être [root]');
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