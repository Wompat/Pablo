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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class UserControllerTest
 * @package Pablo\UserBundle\Tests\Controller
 */
class UserControllerTest extends WebTestCase
{
    /**
     * Client
     */
    private $client = null;

    /**
     * Initialise le client.
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Teste le formulaire d'ajout d'un utilisateur :
     * 1. Vérifie que l'utilisateur dispose des privilèges suffisants.
     * 2. Vérifie qu'un seul utilisateur peut être lié à un employé.
     * 3. Vérifie l'affichage du formulaire.
     * 4. Vérifie que le bouton [annuler] redirige vers la fiche professeur.
     */
    public function testAddAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour créer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'bonjour');
        $this->client->request('GET', '/user/add/1');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [403]');
        $this->client->request('GET', '/logout');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'un seul utilisateur peut être lié à un employé
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour');
        $this->client->request('GET', '/user/add/1');
        $this->assertEquals(500, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [500]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le formulaire est bien affiché
        // -------------------------------------------------------------------------------------------------------------
        $crawler = $this->client->request('GET', '/user/add/4');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Ajouter un utilisateur")')->count(), 'Devrait afficher [user create]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le bouton annuler renvoie vers la fiche professeur
        // -------------------------------------------------------------------------------------------------------------
        $cancelLink = $crawler->filter('div.form-actions a.btn');
        $crawler = $this->client->click($cancelLink->link());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Professeur")')->count(), 'Devrait rediriger vers [employe show]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Teste la création de l'utilisateur :
     * 1. Vérifie la redirection vers la fiche professeur.
     * 2. Vérifie la présence d'un message flash.
     */
    public function testCreateAction()
    {
        $this->logIn('root', 'bonjour');
        $crawler = $this->client->request('GET', '/user/add/4');

        $button = $crawler->selectButton('valider');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur a été créé
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            'pablo_userbundle_usertype[username]' => 'test',
            'pablo_userbundle_usertype[plainPassword][first]' => 'test',
            'pablo_userbundle_usertype[plainPassword][second]' => 'test',
            'pablo_userbundle_usertype[groups]' => 1
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Professeur")')->count(), 'Devrait rediriger vers [employe show]');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("L\'utilisateur a été créé avec succès.")')->count(), 'Devrait afficher [utilisateur créé]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Teste le formulaire d'édition d'un utilisateur :
     * 1. Vérifie que l'utilisateur dispose des privilèges suffisants.
     * 2. Vérife l'affichage du formulaire.
     * 3. Vérifie que le bouton [annuler] redirige vers la fiche professeur.
     */
    public function testEditAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour créer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'bonjour');
        $this->client->request('GET', '/user/edit/4');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut [403]');
        $this->client->request('GET', '/logout');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le formulaire est bien affiché
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour');
        $crawler = $this->client->request('GET', '/user/edit/4');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Modifier un utilisateur")')->count(), 'Devrait afficher [user edit]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le bouton annuler renvoie vers la fiche professeur
        // -------------------------------------------------------------------------------------------------------------
        $cancelLink = $crawler->filter('div.form-actions a.btn');
        $crawler = $this->client->click($cancelLink->link());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Professeur")')->count(), 'Devrait rediriger vers [employe show]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Teste la modification de l'utilisateur :
     * 1. Vérifie la redirection vers la fiche professeur.
     * 2. Vérifie la présence d'un message flash.
     */
    public function testUpdateAction()
    {
        $this->logIn('root', 'bonjour');
        $crawler = $this->client->request('GET', '/user/edit/4');

        $button = $crawler->selectButton('valider');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur a été modifié
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            'pablo_userbundle_usertype[username]' => 'test',
            'pablo_userbundle_usertype[plainPassword][first]' => 'password',
            'pablo_userbundle_usertype[plainPassword][second]' => 'password',
            'pablo_userbundle_usertype[groups]' => 1
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Professeur")')->count(), 'Devrait rediriger vers [employe show]');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("L\'utilisateur a été modifié.")')->count(), 'Devrait afficher [utilisateur modifié]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Teste l'activation/désactivation d'un utilisateur :
     * 1. Vérifie que l'utilisateur dispose des privilèges suffisants.
     * 2. Vérifie la présence d'un message flash.
     */
    public function testEnableAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour activer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'bonjour');
        $this->client->request('GET', '/user/enable/4');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut [403]');
        $this->client->request('GET', '/logout');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien désactivé
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour');

        $this->client->request('GET', '/user/enable/4');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été désactivé.")')->count(), 'Devrait afficher [utilisateur désactivé]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien réactivé
        // -------------------------------------------------------------------------------------------------------------
        $this->client->request('GET', '/user/enable/4');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été activé.")')->count(), 'Devrait afficher [utilisateur activé]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Teste la suppression d'un utilisateur :
     * 1. Vérifie que l'utilisateur dispose des privilèges suffisants.
     * 2. Vérifie la présence d'un message flash.
     */
    public function testDeleteAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour supprimer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'bonjour');
        $this->client->request('GET', '/user/delete/4');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut [403]');
        $this->client->request('GET', '/logout');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien supprimé
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour');
        $this->client->request('GET', '/user/delete/4');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut [200]');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été supprimé.")')->count(), 'Devrait afficher [utilisateur supprimé]');

        $this->client->request('GET', '/logout');
    }

    /**
     * Authentifie un utilisateur en fonction du nom et du mot de passe.
     * @param $username : nom d'utilisateur
     * @param $password : mot de passe en clair
     */
    private function logIn($username, $password)
    {
        $crawler = $this->client->request('GET', '/login');

        $button = $crawler->selectButton('Connexion');
        $form = $button->form();

        $this->client->submit($form, array(
            '_username' => $username,
            '_password' => $password,
        ));
    }
}