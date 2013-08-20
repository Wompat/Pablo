<?php


/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\UserBundle\Entity\User;
use Pablo\UserBundle\Form\UserType;

/**
 * Class UserController
 * @package Pablo\UserBundle\Controller
 */
class UserController extends Controller
{
    /**
     * Affiche le formulaire de création d'un nouvel utilisateur
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \InvalidArgumentException
     */
    public function addAction($id, Employe $employe)
    {
        if (null !== $employe->getUser()) {
            throw new \InvalidArgumentException('Un utilisateur est déjà lié à cet employé.');
        }

        $user = new User();
        $user->setEmploye($employe);

        $form = $this->createForm(new UserType(), $user);

        return $this->render('PabloUserBundle:User:create.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et enregistre le nouvel utilisateur
     * Redirige vers la fiche de l'employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($id, Employe $employe)
    {
        $user = new User();
        $user->setEmploye($employe);

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);
            $user->eraseCredentials();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'utilisateur a été créé avec succès.',
            ));

            $url = $this->generateUrl('pablo_employe_show', array('id' => $user->getEmploye()->getId()));
            return $this->redirect($url);
        }

        return $this->render('PabloUserBundle:User:create.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Affiche le formulaire d'édition d'un utilisateur existant
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Employe $employe)
    {
        $user = $employe->getUser();

        $form = $this->createForm(new UserType(), $user);

        return $this->render('PabloUserBundle:User:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et enregistre l'utilisateur modifiée
     * Redirige vers la fiche de l'employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Employe $employe)
    {
        $user = $employe->getUser();

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
            $user->setPassword($password);
            $user->eraseCredentials();

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'utilisateur a été modifié.',
            ));

            $url = $this->generateUrl('pablo_employe_show', array('id' => $user->getEmploye()->getId()));
            return $this->redirect($url);
        }

        return $this->render('PabloUserBundle:User:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Active ou désactive un utilisateur
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function enableAction($id, Employe $employe)
    {
        $user = $employe->getUser();
        $user->setEnabled(!$user->getEnabled());

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $result = ($user->getEnabled()) ? 'activé' : 'désactivé';

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => 'success',
            'content' => 'L\'utilisateur a été ' . $result . '.',
        ));

        $url = $this->generateUrl('pablo_employe_show', array('id' => $user->getEmploye()->getId()));
        return $this->redirect($url);
    }

    /**
     * Supprime l'utilisateur
     * Redirige vers la fiche de l'employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, Employe $employe)
    {
        $user = $employe->getUser();

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'L\'utilisateur a été supprimé.',
        ));

        $url = $this->generateUrl('pablo_employe_show', array('id' => $user->getEmploye()->getId()));
        return $this->redirect($url);
    }
}