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
        // 1. Vérifie que les "a" accentués sont remplacés par A.
        $this->personne->setNom('aàáâãäAÀÁÂÃÄ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('AÀÁÂÃÄAÀÁÂÃÄ', $actualNom, 'Devrait remplacer tous les "a" par [A]');

        // 2. Vérifie que les "ç" sont remplacés par C.
        $this->personne->setNom('cçCÇ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('CÇCÇ', $actualNom, 'Devrait remplacer tous les "c" par [C]');

        // 3. Vérifie que les "e" accentués sont remplacés par E.
        $this->personne->setNom('eèéêëEÈÉÊË');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('EÈÉÊËEÈÉÊË', $actualNom, 'Devrait remplacer tous les "e" par [E]');

        // 4. Vérifie que les "i" accentués sont remplacés par I.
        $this->personne->setNom('iìíîïIÌÍÎÏ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('IÌÍÎÏIÌÍÎÏ', $actualNom, 'Devrait remplacer tous les "i" par [I]');

        // 5. Vérifie que les "n" accentués sont remplacés par "N".
        $this->personne->setNom('nñNÑ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('NÑNÑ', $actualNom, 'Devrait remplacer tous les "n" par [N]');

        // 6. Vérifie que les "o" accentués sont remplacés par "O".
        $this->personne->setNom('oòóôõöOÒÓÔÕÖ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('OÒÓÔÕÖOÒÓÔÕÖ', $actualNom, 'Devrait remplacer tous les "o" par [O]');

        // 7. Vérifie que les "u" accentués sont remplacés par "U".
        $this->personne->setNom('uùúûüUÙÚÛÜ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('UÙÚÛÜUÙÚÛÜ', $actualNom, 'Devrait remplacer tous les "u" par [U]');

        // 8. Vérifie que les "y" accentués sont remplacés par "Y".
        $this->personne->setNom('yýÿYÝŸ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('YÝŸYÝŸ', $actualNom, 'Devrait remplacer tous les "y" par [Y]');

        // Vérifie que toutes les lettres accentuées sont transfomées en majuscules non accentuées.
        $this->personne->setNom('aàáâãäAÀÁÂÃÄcçCÇeèéêëEÈÉÊËiìíîïIÌÍÎÏnñNÑoòóôõöOÒÓÔÕÖuùúûüUÙÚÛÜyýÿYÝŸ');
        $actualNom = $this->personne->getNom();
        $this->assertEquals('AÀÁÂÃÄAÀÁÂÃÄCÇCÇEÈÉÊËEÈÉÊËIÌÍÎÏIÌÍÎÏNÑNÑOÒÓÔÕÖOÒÓÔÕÖUÙÚÛÜUÙÚÛÜYÝŸYÝŸ', $actualNom,
            'Devrait mettre tous les caractères en [majuscules]'
        );
    }
}
