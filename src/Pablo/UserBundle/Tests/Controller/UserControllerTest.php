<?php

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testAddAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour créer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'admin', array('ROLE_ADMIN'));
        $this->client->request('GET', '/user/add/1');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <403>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'un seul utilisateur peut être lié à un employé
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
        $this->client->request('GET', '/user/add/1');
        $this->assertEquals(500, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <500>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le formulaire est bien affiché
        // -------------------------------------------------------------------------------------------------------------
        $crawler = $this->client->request('GET', '/user/add/3');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Ajouter un utilisateur")')->count(), 'Devrait afficher <user create>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le bouton annuler renvoie vers la fiche professeur
        // -------------------------------------------------------------------------------------------------------------
        $cancelLink = $crawler->filter('div.form-actions a.btn');
        $crawler = $this->client->click($cancelLink->link());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche professeur")')->count(), 'Devrait rediriger vers <employe show>');
    }

    public function testCreateAction()
    {
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
        $crawler = $this->client->request('GET', '/user/add/3');

        $button = $crawler->selectButton('valider');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur a été créé
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            'pablo_userbundle_usertype[username]' => 'user',
            'pablo_userbundle_usertype[plainPassword][first]' => 'user',
            'pablo_userbundle_usertype[plainPassword][second]' => 'user',
            'pablo_userbundle_usertype[groups]' => 1
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche professeur")')->count(), 'Devrait rediriger vers <employe show>');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("L\'utilisateur a été créé avec succès.")')->count(), 'Devrait afficher <utilisateur créé>');
    }

    public function testEditAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour créer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'admin', array('ROLE_ADMIN'));
        $this->client->request('GET', '/user/edit/3');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut <403>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le formulaire est bien affiché
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
        $crawler = $this->client->request('GET', '/user/edit/3');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Modifier un utilisateur")')->count(), 'Devrait afficher <user edit>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le bouton annuler renvoie vers la fiche professeur
        // -------------------------------------------------------------------------------------------------------------
        $cancelLink = $crawler->filter('div.form-actions a.btn');
        $crawler = $this->client->click($cancelLink->link());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche professeur")')->count(), 'Devrait rediriger vers <employe show>');
    }

    public function testUpdateAction()
    {
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
        $crawler = $this->client->request('GET', '/user/edit/3');

        $button = $crawler->selectButton('valider');
        $form = $button->form();

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur a été modifié
        // -------------------------------------------------------------------------------------------------------------
        $this->client->submit($form, array(
            'pablo_userbundle_usertype[username]' => 'user',
            'pablo_userbundle_usertype[plainPassword][first]' => 'password',
            'pablo_userbundle_usertype[plainPassword][second]' => 'password',
            'pablo_userbundle_usertype[groups]' => 1
        ));

        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Fiche professeur")')->count(), 'Devrait rediriger vers <employe show>');
        $this->assertEquals(1, $crawler->filter('div.alert-success:contains("L\'utilisateur a été modifié.")')->count(), 'Devrait afficher <utilisateur modifié>');
    }

    public function testEnableAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour supprimer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'admin', array('ROLE_ADMIN'));
        $this->client->request('GET', '/user/enable/3');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut <403>');

        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien désactivé
        // -------------------------------------------------------------------------------------------------------------
        $this->client->request('GET', '/user/enable/3');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été désactivé.")')->count(), 'Devrait afficher <utilisateur désactivé>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien réactivé
        // -------------------------------------------------------------------------------------------------------------
        $this->client->request('GET', '/user/enable/3');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été activé.")')->count(), 'Devrait afficher <utilisateur activé>');
    }

    public function testDeleteAction()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie qu'il faut au moins le privilège SUPER_ADMIN pour supprimer un utilisateur.
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('admin', 'admin', array('ROLE_ADMIN'));
        $this->client->request('GET', '/user/delete/3');
        $this->assertEquals(403, $this->client->getResponse()->getStatusCode(), 'Admin devrait avoir le statut <403>');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur est bien supprimé
        // -------------------------------------------------------------------------------------------------------------
        $this->logIn('root', 'bonjour', array('ROLE_SUPER_ADMIN'));
        $this->client->request('GET', '/user/delete/3');
        $crawler = $this->client->followRedirect();
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Root devrait avoir le statut <200>');
        $this->assertEquals(1, $crawler->filter('div.alert:contains("L\'utilisateur a été supprimé.")')->count(), 'Devrait afficher <utilisateur supprimé>');
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