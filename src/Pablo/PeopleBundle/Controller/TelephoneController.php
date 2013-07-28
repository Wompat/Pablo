<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Telephone;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\TelephoneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TelephoneController extends Controller
{
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