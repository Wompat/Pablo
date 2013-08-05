<?php

namespace Pablo\PeopleBundle\Tests\Unit;


use Pablo\PeopleBundle\Entity\Personne;

class PersonneTest extends \PHPUnit_Framework_TestCase
{
    private $personne;

    public function setUp()
    {
        $this->personne = new Personne();
    }

    public function testGetNom()
    {
        // Vérifie que les "a" accentués sont remplacés par A.
        $this->personne->setNom('aàáâãäAÀÁÂÃÄ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('AAAAAAAAAAAA', $actualPrenom, 'Devrait remplacer les "a" accentués par [A]');

        // Vérifie que les "ç" sont remplacés par C.
        $this->personne->setNom('cçCÇ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('CCCC', $actualPrenom, 'Devrait remplacer les "ç" par [C]');

        // Vérifie que les "e" accentués sont remplacés par E.
        $this->personne->setNom('eèéêëEÈÉÊË');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('EEEEEEEEEE', $actualPrenom, 'Devrait remplacer les "e" accentués par [E]');

        // Vérifie que les "i" accentués sont remplacés par I.
        $this->personne->setNom('iìíîïIÌÍÎÏ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('IIIIIIIIII', $actualPrenom, 'Devrait remplacer les "i" accentués par [I]');

        // Vérifie que les "n" accentués sont remplacés par "N".
        $this->personne->setNom('nñNÑ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('NNNN', $actualPrenom, 'Devrait remplacer les "n" accentués par [N]');

        // Vérifie que les "o" accentués sont remplacés par "O".
        $this->personne->setNom('oòóôõöOÒÓÔÕÖ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('OOOOOOOOOOOO', $actualPrenom, 'Devrait remplacer les "o" accentués par [O]');

        // Vérifie que les "u" accentués sont remplacés par "U".
        $this->personne->setNom('uùúûüUÙÚÛÜ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('UUUUUUUUUU', $actualPrenom, 'Devrait remplacer les "u" accentués par [U]');

        // Vérifie que les "y" accentués sont remplacés par "Y".
        $this->personne->setNom('yýÿYÝ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('YYYYY', $actualPrenom, 'Devrait remplacer les "y" accentués par [Y]');

        // Vérifie que toutes les lettres accentuées sont transfomées en majuscules non accentuées.
        $this->personne->setNom('aàáâãäAÀÁÂÃÄcçCÇeèéêëEÈÉÊËiìíîïIÌÍÎÏnñNÑoòóôõöOÒÓÔÕÖuùúûüUÙÚÛÜyýÿYÝ');
        $actualPrenom = $this->personne->getNom();
        $this->assertEquals('AAAAAAAAAAAACCCCEEEEEEEEEEIIIIIIIIIINNNNOOOOOOOOOOOOUUUUUUUUUUYYYYY', $actualPrenom,
            'Les lettres accentuées devrait être remplacées par une [majuscule non accentuée]'
        );
    }

    /**
     * @depends testGetNom
     */
    public function testGetPrenom()
    {
        // Vérifie que toutes les lettres accentuées sont transfomées en majuscules non accentuées.
        $this->personne->setPreNom('aàáâãäAÀÁÂÃÄcçCÇeèéêëEÈÉÊËiìíîïIÌÍÎÏnñNÑoòóôõöOÒÓÔÕÖuùúûüUÙÚÛÜyýÿYÝ');
        $actualNom = $this->personne->getPrenom();
        $this->assertEquals('AAAAAAAAAAAACCCCEEEEEEEEEEIIIIIIIIIINNNNOOOOOOOOOOOOUUUUUUUUUUYYYYY', $actualNom,
            'Les lettres accentuées devrait être remplacées par une [majuscule non accentuée]'
        );
    }
}
