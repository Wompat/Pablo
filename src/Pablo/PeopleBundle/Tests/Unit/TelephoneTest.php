<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Thomas
 * Date: 9/08/13
 * Time: 16:40
 * To change this template use File | Settings | File Templates.
 */

namespace Pablo\PeopleBundle\Tests\Unit;


use Pablo\PeopleBundle\Entity\Telephone;

class TelephoneTest extends \PHPUnit_Framework_TestCase
{
    public function testSetNumero() {
        $telephone = new Telephone();
        $telephone->setNumero('A0 B1-C2+D3.E4/F5,G6~H7?I8!J9');

        $actualNumero = $telephone->getNumero();
        $this->assertEquals('0123456789', $actualNumero, 'Ne devrait contenir que des [chiffres]');
    }
}
