<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class PersonneController
 * @package Pablo\PeopleBundle\Controller
 */
class PersonneController extends Controller
{
    /**
     * Affiche la liste paginée des personnes (50 éléments par page)
     *
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository('PabloPeopleBundle:Personne')->getListePaginee(50, $page);

        $form = $this->createForm(new SearchType(), new Personne());

        return $this->render('PabloPeopleBundle:Personne:list.html.twig', array(
            'form' => $form->createView(),
            'page' => $page,
            'pages' => ceil(count($personnes)/50),
            'personnes' => $personnes,
        ));
    }

    /**
     * Récupère les critères de recherche et affiche les résultats correspondants
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction()
    {
        $personne = new Personne();
        $form = $this->createForm(new SearchType(), $personne);
        $form->handleRequest($this->getRequest());

        $em = $this->getDoctrine()->getManager();
        $personnes = $em->getRepository('PabloPeopleBundle:Personne')->search($personne);

        return $this->render('PabloPeopleBundle:Personne:result.html.twig', array(
            'form' => $form->createView(),
            'personnes' => $personnes
        ));
    }

    /**
     * Affiche la fiche d'une personne
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id, Personne $personne)
    {
        return $this->render('PabloPeopleBundle:Personne:show.html.twig', array(
            'personne' => $personne,
        ));
    }

    /**
     * Affiche le formulaire d'édition des données personnelles
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Personne $personne)
    {
        $form = $this->createForm(new PersonneType(), $personne);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Personne:edit.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et enregistre les données personnelles modifiées.
     * Réaffiche la fiche de la personne.
     *
     * @param $id
     * @param Personne $personne
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Personne $personne)
    {
        $form = $this->createForm(new PersonneType(), $personne);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Les données personnelles ont été enregistrées.'
            ));

            return $this->render('PabloPeopleBundle:Personne:show.html.twig', array(
                'personne' => $personne,
            ));
        }

        return $this->render('PabloPeopleBundle:Personne:edit.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }
}