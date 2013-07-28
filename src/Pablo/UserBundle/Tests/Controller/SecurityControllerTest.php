<?php

namespace Pablo\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();
        $client->followRedirects();
        $client->request('GET', '/login');

        $crawler = $client->getCrawler();

        $this->assertEquals(1, $crawler->filter('h2.form-signin-heading:contains("Pablo!")')->count(), 'Form signin heading should contains <Pablo!>');
        $this->assertEquals(1, $crawler->filter('input[type=text][name=_username][required=required]')->count(), 'Form signin should contains <1 required text input with name _username>');
        $this->assertEquals(1, $crawler->filter('input[type=password][name=_password][required=required]')->count(), 'Form signin should contains <1 required password input with name _password>');
        $this->assertEquals(1, $crawler->filter('label.checkbox:contains("Se souvenir de moi")')->count(), 'Form signin should contains <label Se souvenir de moi>');
        $this->assertEquals(1, $crawler->filter('input[type=checkbox][name=_remember_me]')->count(), 'Form signin should contains <1 checkbox with name _remember_me>');
        $this->assertEquals(1, $crawler->filter('input[type=submit][value=Connexion]')->count(), 'Form signin should contains a <1 submit button with Connexion as value');

        $button = $crawler->selectButton('Connexion');
        $form = $button->form();

        $client->submit($form, array(
            '_username' => 'noname',
            '_password' => 'nopassword',
        ));

        $this->assertEquals(1, $crawler->filter('div:contains("Bad credentials")')->count());
    }
}