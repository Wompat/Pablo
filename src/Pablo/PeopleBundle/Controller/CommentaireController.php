<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Entity\Commentaire;
use Pablo\PeopleBundle\Form\CommentaireType;

class CommentaireController extends Controller
{
    public function addAction($id, Personne $personne)
    {
        $commentaire = new Commentaire();
        $commentaire->setPersonne($personne);
        $commentaire->setUser($this->getUser());

        $form = $this->createForm(new CommentaireType(), $commentaire);

        if ($commentaire->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        }

        return $this->render('PabloPeopleBundle:Commentaire:create.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    public function createAction($id, Personne $personne)
    {
        $commentaire = new Commentaire();
        $commentaire->setPersonne($personne);
        $commentaire->setUser($this->getUser());

        $form = $this->createForm(new CommentaireType(), $commentaire);
        $form->handleRequest($this->getRequest());

        if ($commentaire->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le commentaire a été enregistré.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Commentaire:create.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    public function editAction($id, Commentaire $commentaire)
    {
        $form = $this->createForm(new CommentaireType(), $commentaire);

        if ($commentaire->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        }

        return $this->render('PabloPeopleBundle:Commentaire:edit.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    public function updateAction($id, Commentaire $commentaire)
    {
        $form = $this->createForm(new CommentaireType(), $commentaire);
        $form->handleRequest($this->getRequest());

        if ($commentaire->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        }

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->Add('notice', array(
                'type' => 'success',
                'content' => 'Le commentaire a été modifié.',
            ));

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Commentaire:edit.html.twig', array(
            'commentaire' => $commentaire,
            'form' => $form->createView(),
            'url' => $url,
        ));
    }

    public function deleteAction($id, Commentaire $commentaire)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($commentaire);
        $em->flush();

        $this->get('session')->getFlashBag()->Add('notice', array(
            'type' => null,
            'content' => 'Le commentaire a été supprimé.'
        ));

        if ($commentaire->getPersonne() instanceof Employe) {
            $url = $this->generateUrl('pablo_employe_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        } else {
            $url = $this->generateUrl('pablo_personne_show', array('id' => $commentaire->getPersonne()->getId())) . '#commentaires';
        }

        return $this->redirect($url);
    }
}