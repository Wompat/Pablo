<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class PersonneControllerTest
 * @package Pablo\PeopleBundle\Tests\Controller
 */
class PersonneControllerTest extends WebTestCase
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
        $this->logIn('root', 'bonjour');
    }

    /**
     * Teste la liste des élèves :
     * 1. Vérifie qu'une alerte est affichée s'il n'y a aucun élève
     * 2. Vérifie qu'un tableau est affiché
     * 3. Vérifie que le lien redirige vers la fiche de l'élève
     */
    public function testListAction()
    {
        $crawler = $this->client->request('GET', '/personne');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode(), 'Devrait avoir le statut [200]');

        $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Liste des élèves")')->count(), 'Devrait rediriger vers [liste des élèves]');

        if ($crawler->filter('html table')->count() == 0) {
            // Vérifie qu'une alerte s'il n'y a aucun élève
            $this->assertEquals(1, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Devrait afficher 1 [alert alert-info]');
        } else {
            // Vérifie qu'il n'y a pas d'alerte et qu'un tableau est affiché.
            $this->assertEquals(0, $crawler->filter('h4.alert-heading:contains("Désolé")')->count(), 'Ne devrait pas afficher [alert alert-info]');
            $this->assertEquals(1, $crawler->filter('div.container table')->count(), 'Devrait afficher [tableau de personnes]');
            $this->assertTrue($crawler->filter('tbody a')->count() >= 1, 'Devrait contenir au moins 1 [lien vers fiche élève]');

            // Vérifie que le lien redirige vers la fiche Élève.
            $personLink = $crawler->filter('tbody a')->first();
            $personLastName = $crawler->filter('td')->siblings()->first()->text();
            $personFirstName = $crawler->filter('td')->siblings()->first()->nextAll()->first()->text();

            $crawler = $this->client->click($personLink->link());
            $this->assertEquals(1, $crawler->filter('div.page-header h2:contains("Élève")')->count(), 'Devrait rediriger vers [fiche élève]');

            $actualName = $personFirstName . ' ' . $personLastName;
            $this->assertEquals(1, $crawler->filter('dl:contains("' . $actualName . '")')->count(), 'Devrait rediriger vers [fiche élève]');
        }
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