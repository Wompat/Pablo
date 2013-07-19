<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Teacher;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\TeacherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeacherController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $teachers = $em->getRepository('PabloPeopleBundle:Teacher')->getPagedList(50, $page);

        $form = $this->createForm(new SearchType(), new Teacher());

        return $this->render('PabloPeopleBundle:Teacher:list.html.twig', array(
            'form' => $form->createView(),
            'page' => $page,
            'pages' => ceil(count($teachers)/50),
            'teachers' => $teachers,
        ));
    }

    public function searchAction()
    {
        $teacher = new Teacher();
        $form = $this->createForm(new SearchType(), $teacher);
        $form->handleRequest($this->getRequest());

        $em = $this->getDoctrine()->getManager();
        $teachers = $em->getRepository('PabloPeopleBundle:Teacher')->search($teacher);

        return $this->render('PabloPeopleBundle:Teacher:result.html.twig', array(
            'form' => $form->createView(),
            'teachers' => $teachers,
            ));
    }

    public function showAction($id, Teacher $teacher)
    {
        return $this->render('PabloPeopleBundle:Teacher:show.html.twig', array(
            'person' => $teacher,
        ));
    }

    public function editAction($id, Teacher $teacher)
    {
        $form = $this->createForm(new TeacherType(), $teacher);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Teacher:edit.html.twig', array(
            'person' => $teacher,
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id, Teacher $teacher)
    {
        $form = $this->createForm(new TeacherType(), $teacher);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Les données personnelles ont été enregistrées.'
            ));

            return $this->render('PabloPeopleBundle:Teacher:show.html.twig', array(
                'person' => $teacher,
            ));
        }

        return $this->render('PabloPeopleBundle:Teacher:edit.html.twig', array(
            'person' => $teacher,
            'form' => $form->createView(),
        ));
    }
}