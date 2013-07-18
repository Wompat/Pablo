<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Form\SearchType;
use Pablo\PeopleBundle\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('PabloPeopleBundle:Student')->getPagedList(50, $page);

        $form = $this->createForm(new SearchType(), new Student());

        return $this->render('PabloPeopleBundle:Student:list.html.twig', array(
            'form' => $form->createView(),
            'page' => $page,
            'pages' => ceil(count($students)/50),
            'students' => $students,
        ));
    }

    public function searchAction()
    {
        $student = new Student();
        $form = $this->createForm(new SearchType(), $student);
        $form->handleRequest($this->getRequest());

        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('PabloPeopleBundle:Student')->search($student);

        return $this->render('PabloPeopleBundle:Student:result.html.twig', array(
            'form' => $form->createView(),
            'students' => $students
        ));
//        return $this->render('PabloPeopleBundle::debug.html.twig', array('var' => $data['dateOfBirth']));
    }

    public function showAction($id, Student $person)
    {
        return $this->render('PabloPeopleBundle:Student:show.html.twig', array(
            'person' => $person,
        ));
    }

    public function editAction($id, Student $student)
    {
        $form = $this->createForm(new StudentType(), $student);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Student:edit.html.twig', array(
            'person' => $student,
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id, Student $student)
    {
        $form = $this->createForm(new StudentType(), $student);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Les données personnelles ont été enregistrées.'
            ));

            return $this->render('PabloPeopleBundle:Student:show.html.twig', array(
                'person' => $student,
            ));
        }

        return $this->render('PabloPeopleBundle:Student:edit.html.twig', array(
            'person' => $student,
            'form' => $form->createView(),
        ));
    }
}