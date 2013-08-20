<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\EmployeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class EmployeController
 * @package Pablo\PeopleBundle\Controller
 */
class EmployeController extends Controller
{
    /**
     * Affiche la liste paginée des employés (50 éléments par page)
     *
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $employes = $em->getRepository('PabloPeopleBundle:Employe')->getListePaginee(50, $page);

        $form = $this->createForm(new SearchType(), new Employe());

        return $this->render('PabloPeopleBundle:Employe:list.html.twig', array(
            'form' => $form->createView(),
            'page' => $page,
            'pages' => ceil(count($employes)/50),
            'employes' => $employes,
        ));
    }

    /**
     * Récupère les critères de recherche et affiche les résultats correspondants
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction()
    {
        $employe = new Employe();
        $form = $this->createForm(new SearchType(), $employe);
        $form->handleRequest($this->getRequest());

        $em = $this->getDoctrine()->getManager();
        $employes = $em->getRepository('PabloPeopleBundle:Employe')->search($employe);

        return $this->render('PabloPeopleBundle:Employe:result.html.twig', array(
            'form' => $form->createView(),
            'employes' => $employes,
            ));
    }

    /**
     * Affiche la fiche d'un employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id, Employe $employe)
    {
        return $this->render('PabloPeopleBundle:Employe:show.html.twig', array(
            'personne' => $employe,
        ));
    }

    /**
     * Affiche le formulaire d'édition des données personnelles de l'employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Employe $employe)
    {
        $form = $this->createForm(new EmployeType(), $employe);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Employe:edit.html.twig', array(
            'personne' => $employe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et met à jour les données personnelles de l'employé.
     * Réaffiche la fiche de l'employé
     *
     * @param $id
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Employe $employe)
    {
        $form = $this->createForm(new EmployeType(), $employe);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Les données personnelles ont été enregistrées.'
            ));

            return $this->render('PabloPeopleBundle:Employe:show.html.twig', array(
                'personne' => $employe,
            ));
        }

        return $this->render('PabloPeopleBundle:Employe:edit.html.twig', array(
            'personne' => $employe,
            'form' => $form->createView(),
        ));
    }
}