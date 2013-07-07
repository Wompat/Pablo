<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('PabloPeopleBundle:Student')->findAll();

        return $this->render('PabloPeopleBundle:Student:list.html.twig', array(
            'students' => $students,
        ));
    }

    public function showAction($id, Student $student)
    {
        return $this->render('PabloPeopleBundle:Student:show.html.twig', array(
            'student' => $student,
        ));
    }

    public function editAction($id, Student $student)
    {
        $form = $this->createForm(new StudentType(), $student);
        $form->handleRequest($this->getRequest());

        return $this->render('PabloPeopleBundle:Student:edit.html.twig', array(
            'student' => $student,
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
                'student' => $student,
            ));
        }

        return $this->render('PabloPeopleBundle:Student:edit.html.twig', array(
            'student' => $student,
            'form' => $form->createView(),
        ));
    }
}