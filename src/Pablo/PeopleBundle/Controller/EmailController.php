<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Email;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class EmailController
 * @package Pablo\PeopleBundle\Controller
 */
class EmailController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'une nouvelle adresse e-mail
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction($id, Personne $personne)
    {
        $email = new Email();
        $email->setPersonne($personne);

        $form = $this->createForm(new EmailType(), $email);

        if ($email->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        }

        return $this->render('PabloPeopleBundle:Email:create.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre la nouvelle adresse e-mail
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($id, Personne $personne)
    {
        $email = new Email();
        $email->setPersonne($personne);

        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($this->getRequest());

        if ($email->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse e-mail a été enregistrée.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Email:create.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Affiche le formulaire d'édition d'une adresse e-mail existante
     *
     * @param $id
     * @param Email $email
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Email $email)
    {
        $form = $this->createForm(new EmailType(), $email);

        if ($email->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        }

        return $this->render('PabloPeopleBundle:Email:edit.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre l'adresse e-mail modifiée
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Email $email
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Email $email)
    {
        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($this->getRequest());

        if ($email->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse e-mail a été modifiée.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Email:edit.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Supprime une adresse e-mail
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Email $email
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, Email $email)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($email);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'L\'adresse e-mail a été supprimée.',
        ));

        if ($email->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $email->getPersonne()->getId())) . '#emails';
        }

        return $this->redirect($url);
    }
}