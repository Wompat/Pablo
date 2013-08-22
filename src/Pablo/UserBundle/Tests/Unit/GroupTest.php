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
 * Class GroupTest
 * @package Pablo\UserBundle\Tests\Unit
 */
class GroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * User
     * @var \Pablo\UserBundle\Entity\User
     */
    private $user;

    /**
     * Root
     * @var \Pablo\UserBundle\Entity\User
     */
    private $root;

    /**
     * Groupe
     * @var \Pablo\UserBundle\Entity\Group
     */
    private $group;

    /**
     * Set Up : initialise les instances des classes User et Group partagées par les différents tests.
     */
    public function setUp()
    {
        $this->user = new User();
        $this->user->setUsername('user');

        $this->root = new User();
        $this->user->setUsername('root');

        $this->group = new Group();
        $this->group->setName('name');
        $this->group->setRole('[ROLE_TEST]');
    }

    /**
     * test GetName : vérifie que le nom du groupe est bien initialisé
     */
    public function testGetName()
    {
        $actualName = $this->group->getName();
        $this->assertEquals('name', $actualName, 'Le nom du groupe devrait être [name]');
    }

    /**
     * test getRole : vérifie que le groupe correspond au rôle [ROLE_TEST]
     */
    public function testGetRole()
    {
        $actualRole = $this->group->getRole();
        $this->assertEquals('[ROLE_TEST]', $actualRole, 'Le role devrait être [ROLE_TEST]');
    }

    /**
     * Test getUsers : vérifie que le groupe ne contient aucun utilisateur par défaut
     */
    public function testGetUsers()
    {
        $actualUsers = $this->group->getUsers();
        $this->assertCount(0, $actualUsers, 'Devrait contenir [aucun utilisateur]');
        $this->assertNotContains($this->user, $actualUsers, 'Ne devrait pas contenir [user]');
        $this->assertNotContains($this->root, $actualUsers, 'Ne devrait pas contenir [root]');
    }

    /**
     * Test addUser : vérifie qu'un utilisateur n'est ajouté qu'une fois dans un groupe.
     * Dépend du test getUsers() puisque la méthode est utilisée dans le test.
     *
     * @depends testGetUsers
     */
    public function testAddUser()
    {
        // l'utilisateur "root" est volontairement ajouté deux fois !
        $this->group->addUser($this->user);
        $this->group->addUser($this->user);

        $actualUsers = $this->group->getUsers();
        $this->assertCount(1, $actualUsers, 'Devrait contenir [1 utilisateur]');
        $this->assertContains($this->user, $actualUsers, 'Devrait contenir [user]');
        $this->assertNotContains($this->root, $actualUsers, 'Ne devrait pas contenir [root]');
    }

    /**
     * Test removeUser : vérifie qu'un utilisateur est supprimé du groupe
     * Dépend du test addUser() puisque la méthode est utilisée dans le test.
     *
     * @depends testAddUser
     */
    public function testRemoveUser()
    {
        $this->group->addUser($this->user);
        $this->group->addUser($this->root);

        $this->group->removeUser($this->root);

        $actualUsers = $this->group->getUsers();
        $this->assertCount(1, $actualUsers, 'Devrait contenir [1 utilisateur]');
        $this->assertContains($this->user, $actualUsers, 'Devrait contenir [user]');
        $this->assertNotContains($this->root, $actualUsers, 'Ne devrait pas contenir [root]');

        // Vérifie que l'on peut retirer un utilisateur même s'il ne fait pas partie du groupe...
        $this->group->removeUser($this->root);

        $actualUsers = $this->group->getUsers();
        $this->assertCount(1, $actualUsers, 'Devrait contenir [1 utilisateur]');
        $this->assertContains($this->user, $actualUsers, 'Devrait contenir [user]');
        $this->assertNotContains($this->root, $actualUsers, 'Ne devrait pas contenir [root]');
    }
}
