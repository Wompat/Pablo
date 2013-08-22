<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Tests\Unit;

use Pablo\UserBundle\Entity\User;
use Pablo\UserBundle\Entity\Group;

/**
 * Class UserTest
 * @package Pablo\UserBundle\Tests\Unit
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * User
     *
     * @var \Pablo\UserBundle\Entity\User
     */
    private $user;

    /**
     * Groupe "utilisateurs"
     *
     * @var \Pablo\UserBundle\Entity\Group
     */
    private $users;

    /**
     * Groupe "administrateurs"
     * @var \Pablo\UserBundle\Entity\Group
     */
    private $admins;

    /**
     * Groupe "super administrateurs"
     *
     * @var \Pablo\UserBundle\Entity\Group
     */
    private $supers;

    /**
     * Crée une instance d'utilisateur utilisée dans les tests.
     * Initialise le nom et le mot de passe en clair.
     *
     * Crée les instances des groupes
     * "utilisateurs", "administrateurs", "super administrateurs"
     * utilisése dans les tests
     */
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

    /**
     * Test getUsername : vérifie que la méthode renvoie le nom de l'utilisateur.
     */
    public function testGetUsername()
    {
        $actualName = $this->user->getUsername();
        $this->assertEquals('root', $actualName, 'Nom devrait valoir [root]');
    }

    /**
     * Test getSalt : vérifie que le sel est bien initialisé automatiquement.
     */
    public function testGetSalt()
    {
        $actualSalt = $this->user->getSalt();
        $this->assertNotNull($actualSalt, 'Sel ne devrait pas valoir [null]');
    }

    /**
     * Test getEnabled : vérifie que l'utilisateur est activé par défaut.
     */
    public function testGetEnabled()
    {
        $actualValue = $this->user->getEnabled();
        $this->assertTrue($actualValue, 'Enabled devrait valoir [true]');
    }

    /**
     * Test getGroups : vérifie que l'utilisateur n'appartient à aucun groupe.
     */
    public function testGetGroups()
    {
        $actualGroups = $this->user->getGroups();
        $this->assertCount(0, $actualGroups, 'Devrait contenir [0 groupe]');
    }

    /**
     * Test addGroup : vérifie que les groupes ne sont ajoutés qu'une seule fois aux groupes de l'utilisateur.
     *
     * @depends testGetGroups
     * @return mixed
     */
    public function testAddGroup()
    {
        // Le groupe "users" est volontairement ajouté deux fois !
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->addGroup($this->users);

        $actualGroups = $this->user->getGroups();
        $this->assertCount(2, $actualGroups, 'Devrait contenir [2 groupes]');
        $this->assertContains($this->users, $actualGroups, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualGroups, 'Devrait contenir [admin]');
    }

    /**
     * Test setGroup : vérifie que le groupe est ajouté aux groupes de l'utilisateur
     * Dépend du test addGroup puisque cette méthode est utilisée par la méthode setGroup.
     *
     * @depends testAddGroup
     */
    public function testSetGroup()
    {
        $this->user->setGroups($this->supers);

        $actualGroups = $this->user->getGroups()->toArray();
        $this->assertCount(1, $actualGroups, 'Devrait contenir [1 groupe]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');
    }

    /**
     * Test removeGroup : vérifie que le groupe est supprimé des groupes de l'utilisateur
     * Dépend du test addGroup puisque la méthode est utilisée dans le test !
     *
     * @depends testAddGroup
     */
    public function testRemoveGroup()
    {
        // Ajoute les trois groupes créés par la méthode setUp aux groupes de l'utilisateur.
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->setGroups($this->supers);

        // Vérifie que les groupes de l'utilisateurs contiennent les groupes ajoutés.
        $actualGroups = $this->user->getGroups();
        $this->assertCount(3, $actualGroups, 'Devrait contenir [3 groupes]');
        $this->assertContains($this->users, $actualGroups, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualGroups, 'Devrait contenir [admins]');
        $this->assertContains($this->supers, $actualGroups, 'Devrait contenir [supers]');

        // Vérifie que le groupe est retiré des groupes de l'utilisateur
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

        // Vérifie que l'on peut retirer un groupe même si l'utilisateur n'en fait pas partie...
        $this->user->removeGroup($this->supers);
        $actualGroups = $this->user->getGroups();
        $this->assertCount(0, $actualGroups, 'Ne devrait contenir aucun [groupe]');
    }

    /**
     * test getRoles : vérifie que l'utilisateur a toujours au moins le rôle [ROLE_USER] par défaut.
     * Dépend du test addGroup puisque la méthode est utilisée dans le test !
     *
     * @depends testAddGroup
     */
    public function testGetRoles()
    {
        // Vérifie que l'utilisateur a au moins le role [ROLE_USER]
        $actualRoles = $this->user->getRoles();
        $this->assertContains('ROLE_USER', $actualRoles, 'Rôle devrait valoir [ROLE_USER]');

        // Vérifie que le rôle du groupe est ajouté aux rôles de l'utilisateur
        $this->user->addGroup($this->users);
        $this->user->addGroup($this->admins);
        $this->user->setGroups($this->supers);

        $actualRoles = $this->user->getRoles();
        $this->assertContains($this->users, $actualRoles, 'Devrait contenir [users]');
        $this->assertContains($this->admins, $actualRoles, 'Devrait contenir [admins]');
        $this->assertContains($this->users, $actualRoles, 'Devrait contenir [supers]');
    }

    /**
     * test eraseCredentials : vérifie que le mot de passe en clair est effacé.
     */
    public function testEraseCredentials()
    {
        $actualValue = $this->user->getPlainPassword();
        $this->assertEquals('bonjour', $actualValue, 'PlainPassword devrait valoir [bonjour]');
        $this->user->eraseCredentials();
        $this->assertNull($this->user->getPlainPassword(), 'PlainPassword devrait être [null]');
    }
}