<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Entity\Commentaire;
use Pablo\PeopleBundle\Form\CommentaireType;

/**
 * Class CommentaireController
 * @package Pablo\PeopleBundle\Controller
 */
class CommentaireController extends Controller
{
    /**
     * Affiche le formulaire d'ajout d'un nouveau commentaire
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Valide le formulaire et enregistre le nouveau commentaire
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Affiche le formulaire d'édition d'un commentaire existant
     *
     * @param $id
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Valide le formulaire et enregistre le commentaire modifié
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Efface un commentaire
     * Redirige vers la fiche de la personne ou de l'employé.
     *
     * @param $id
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
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