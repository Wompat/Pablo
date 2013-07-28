<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Employe;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\EmployeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmployeController extends Controller
{
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

    public function showAction($id, Employe $employe)
    {
        return $this->render('PabloPeopleBundle:Employe:show.html.twig', array(
            'personne' => $employe,
        ));
    }

    public function editAction($id, Employe $employe)
    {
        $form = $this->createForm(new EmployeType(), $employe);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Employe:edit.html.twig', array(
            'personne' => $employe,
            'form' => $form->createView(),
        ));
    }

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