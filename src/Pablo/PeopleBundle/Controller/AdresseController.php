<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Adresse;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\AdresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdresseController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $adresses = $em->getRepository('PabloPeopleBundle:Adresse')->findAll();

        return $this->render('PabloPeopleBundle:Adresse:list.html.twig', array(
            'adresses' => $adresses,
        ));
    }

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
     * Affiche le formulaire d'édition d'une adresse
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
     * Valide le formulaire et met l'adresse à jour
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