<?php

namespace Pablo\UserBundle\Tests\Unit;

use Pablo\UserBundle\Entity\User;
use Pablo\UserBundle\Entity\Group;

class UserTest extends \PHPUnit_Framework_TestCase
{
    private $user;
    private $users;
    private $admins;
    private $supers;

    public function setUp()
    {
        $this->user = new User();
        $this
            ->user->setUsername('root')
            ->setPlainPassword('bonjour')
        ;

        $this->users = new Group();
        $this->users
            ->setName('Utilisateurs')
            ->setRole('ROLE_USER')
        ;

        $this->admins = new Group();
        $this->admins
            ->setName('Administrateurs')
            ->setRole('ROLE_ADMIN')
        ;

        $this->supers = new Group();
        $this->supers
            ->setName('Super Administrateurs')
            ->setRole('ROLE_SUPER_ADMIN')
        ;
    }

    public function testGetUsername()
    {
        $actualName = $this->user->getUsername();
        $this->assertEquals('root', $actualName, 'Nom devrait valoir [root]');
    }

    public function testGetSalt()
    {
        $actualSalt = $this->user->getSalt();
        $this->assertNotNull($actualSalt, 'Sel ne devrait pas valoir [null]');
    }

    public function testGetEnabled()
    {
        $actualValue = $this->user->getEnabled();
        $this->assertTrue($actualValue, 'Enabled devrait valoir [true]');
    }

    public function testGetGroups()
    {
        $actualGroups = $this->user->getGroups();
        $this->assertCount(0, $actualGroups, 'Devrait contenir [0 groupe]');
    }

    /**
     * @depends testGetGroups
     * @return mixed
     */
    public function testAddGroup()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que les groupes ne sont ajoutés qu'une fois aux groupes de l'utilisateur
        // -------------------------------------------------------------------------------------------------------------
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->addGroup($this->users);

        $actualGroups = $this->user->getGroups();
        $this->assertCount(2, $actualGroups, 'Devrait contenir [2 groupes]');
        $this->assertContains($this->users, $actualGroups, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualGroups, 'Devrait contenir [admin]');
    }

    /**
     * @depends testAddGroup
     */
    public function testSetGroup()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le groupe est ajouté aux groupes de l'utilisateur
        // -------------------------------------------------------------------------------------------------------------
        $this->user->setGroups($this->supers);

        $actualGroups = $this->user->getGroups()->toArray();
        $this->assertCount(1, $actualGroups, 'Devrait contenir [1 groupe]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');
    }

    /**
     * @depends testAddGroup
     */
    public function testRemoveGroup()
    {
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->setGroups($this->supers);

        $actualGroups = $this->user->getGroups();
        $this->assertCount(3, $actualGroups, 'Devrait contenir [3 groupes]');
        $this->assertContains($this->users, $actualGroups, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualGroups, 'Devrait contenir [admins]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le groupe est retiré des groupes de l'utilisateur
        // -------------------------------------------------------------------------------------------------------------
        $this->user->removeGroup($this->users);
        $actualGroups = $this->user->getGroups();
        $this->assertCount(2, $actualGroups, 'Devrait contenir [2 groupes]');
        $this->assertNotContains($this->users, $actualGroups, 'Ne devrait plus contenir [users]');
        $this->assertContains($this->admins, $actualGroups, 'Devrait contenir [admins]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');

        $this->user->removeGroup($this->admins);
        $actualGroups = $this->user->getGroups();
        $this->assertCount(1, $actualGroups, 'Devrait contenir [1 groupe]');
        $this->assertNotContains($this->users, $actualGroups, 'Ne devrait plus contenir [users]');
        $this->assertNotContains($this->admins, $actualGroups, 'Ne devrait plus contenir [admins]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');

        $this->user->removeGroup($this->supers);
        $actualGroups = $this->user->getGroups();
        $this->assertCount(0, $actualGroups, 'Ne devrait contenir aucun [groupe]');
        $this->assertNotContains($this->users, $actualGroups, 'Ne devrait plus contenir [users]');
        $this->assertNotContains($this->admins, $actualGroups, 'Ne devrait plus contenir [admins]');
        $this->assertNotContains($this->supers, $actualGroups, 'Ne devrait plus contenir [supers]');
    }

    public function testGetRoles()
    {
        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que l'utilisateur a au moins le role [ROLE_USER]
        // -------------------------------------------------------------------------------------------------------------
        $actualRoles = $this->user->getRoles();
        $this->assertContains('ROLE_USER', $actualRoles, 'Rôle devrait valoir [ROLE_USER]');

        // -------------------------------------------------------------------------------------------------------------
        // Vérifie que le rôle du groupe est ajouté aux rôles de l'utilisateur
        // -------------------------------------------------------------------------------------------------------------
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->setGroups($this->supers);

        $actualRoles = $this->user->getRoles();
        $this->assertContains($this->users, $actualRoles, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualRoles, 'Devrait contenir [admins]');
        $this->assertContains($this->users, $actualRoles, 'Devrait contenir [supers]');
    }

    public function testEraseCredentials()
    {
        $actualValue = $this->user->getPlainPassword();
        $this->assertEquals('bonjour', $actualValue, 'PlainPassword devrait valoir [bonjour]');
        $this->user->eraseCredentials();
        $this->assertNull($this->user->getPlainPassword(), 'PlainPassword devrait être [null]');
    }
}