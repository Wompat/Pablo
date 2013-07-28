<?php

namespace Pablo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\UserBundle\Entity\User;
use Pablo\UserBundle\Form\UserType;

class UserController extends Controller
{
    public function addAction($id, Employe $employe)
    {
//        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
//            throw new AccessDeniedException();
//        }

        $user = new User();
        $user->setEmploye($employe);

        $form = $this->createForm(new UserType(), $user);

        return $this->render('PabloUserBundle:User:create.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

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

    public function editAction($id, Employe $employe)
    {
        $user = $employe->getUser();

        $form = $this->createForm(new UserType(), $user);

        return $this->render('PabloUserBundle:User:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

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

    public function enableAction($id, Employe $employe)
    {
        $user = $employe->getUser();
        $user->setEnabled(!$user->getEnabled());

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => 'success',
            'content' => 'L\'utilisateur a été modifié.',
        ));

        $url = $this->generateUrl('pablo_employe_show', array('id' => $user->getEmploye()->getId()));
        return $this->redirect($url);
    }

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