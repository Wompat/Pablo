<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Personne;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonneController extends Controller
{
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

    public function showAction($id, Personne $personne)
    {
        return $this->render('PabloPeopleBundle:Personne:show.html.twig', array(
            'personne' => $personne,
        ));
    }

    public function editAction($id, Personne $personne)
    {
        $form = $this->createForm(new PersonneType(), $personne);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Personne:edit.html.twig', array(
            'personne' => $personne,
            'form' => $form->createView(),
        ));
    }

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