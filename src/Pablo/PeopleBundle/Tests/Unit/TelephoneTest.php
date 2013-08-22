<?php
/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Tests\Unit;

use Pablo\PeopleBundle\Entity\Telephone;

/**
 * Class TelephoneTest
 * @package Pablo\PeopleBundle\Tests\Unit
 */
class TelephoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setNumero :
     * 1. Vérifie que tous les caractères non numériques sont supprimés.
     */
    public function testSetNumero() {
        $telephone = new Telephone();
        $telephone->setNumero('A0 B1-C2+D3.E4/F5,G6~H7?I8!J9');

        $actualNumero = $telephone->getNumero();
        $this->assertEquals('0123456789', $actualNumero, 'Ne devrait contenir que des [chiffres]');
    }
}
