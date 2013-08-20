<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Adresse;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class AdresseController
 * @package Pablo\PeopleBundle\Controller
 */
class AdresseController extends Controller
{
    /**
     * Affiche la liste des personnes et employés avec leur(s) adresse(s)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adresses = $em->getRepository('PabloPeopleBundle:Adresse')->findAll();

        return $this->render('PabloPeopleBundle:Adresse:list.html.twig', array(
            'adresses' => $adresses,
        ));
    }

    /**
     * Affiche le formulaire d'ajout d'une nouvelle adresse
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction($id, Personne $personne)
    {
        $adresse = new Adresse();
        $adresse->setPersonne($personne);

        $form = $this->createForm(new AdresseType(), $adresse);

        if ($adresse->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        }

        return $this->render('PabloPeopleBundle:Adresse:create.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre la nouvelle adresse
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($id, Personne $personne)
    {
        $adresse = new Adresse();
        $adresse->setPersonne($personne);

        $form = $this->createForm(new AdresseType(), $adresse);
        $form->handleRequest($this->getRequest());

        if ($adresse->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse a été enregistrée.'
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Adresse:create.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Affiche le formulaire d'édition d'une adresse exitante
     *
     * @param $id
     * @param Adresse $adresse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Adresse $adresse)
    {
        $form = $this->createForm(new AdresseType(), $adresse);

        if ($adresse->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        }

        return $this->render('PabloPeopleBundle:Adresse:edit.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Valide le formulaire et enregistre l'adresse modifiée
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param \Pablo\PeopleBundle\Entity\Adresse $adresse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Adresse $adresse)
    {
        $form = $this->createForm(new AdresseType(), $adresse);
        $form->handleRequest($this->getRequest());

        if ($adresse->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse a été modifiée.'
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Adresse:edit.html.twig', array(
            'adresse' => $adresse,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    /**
     * Efface une adresse
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Adresse $adresse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id, Adresse $adresse)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($adresse);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'L\'adresse a été supprimée.'
        ));

        if ($adresse->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $adresse->getPersonne()->getId())) . '#adresses';
        }

        return $this->redirect($url);
    }
}