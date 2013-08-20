<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Telephone;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\TelephoneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TelephoneController
 * @package Pablo\PeopleBundle\Controller
 */
class TelephoneController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'un nouveau numéro de téléphone
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction($id, Personne $personne)
    {
        $telephone = new Telephone();
        $telephone->setPersonne($personne);

        $form = $this->createForm(new TelephoneType(), $telephone);

        if ($telephone->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        }

        return $this->render('PabloPeopleBundle:Telephone:create.html.twig', array(
            'telephone' => $telephone,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre le nouveau numéro de téléphone.
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($id, Personne $personne)
    {
        $telephone = new Telephone();
        $telephone->setPersonne($personne);

        $form = $this->createForm(new TelephoneType(), $telephone);
        $form->handleRequest($this->getRequest());

        if ($telephone->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($telephone);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le numéro a été enregistré.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Telephone:create.html.twig', array(
            'telephone' => $telephone,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Affiche le formulaire d'édition d'un numéro de téléphone existant
     *
     * @param $id
     * @param Telephone $telephone
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Telephone $telephone)
    {
        $form = $this->createForm(new TelephoneType(), $telephone);

        if ($telephone->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        }

        return $this->render('PabloPeopleBundle:Telephone:edit.html.twig', array(
            'telephone' => $telephone,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre le numéro de téléphone modifié.
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Telephone $telephone
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Telephone $telephone)
    {
        $form = $this->createForm(new TelephoneType(), $telephone);
        $form->handleRequest($this->getRequest());

        if ($telephone->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le numéro a été modifié.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Telephone:edit.html.twig', array(
            'telephone' => $telephone,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Efface un numéro de téléphone
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Telephone $telephone
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, Telephone $telephone)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($telephone);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'Le numéro a été supprimé.',
        ));

        if ($telephone->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $telephone->getPersonne()->getId())) . '#telephones';
        }

        return $this->redirect($url);
    }
}