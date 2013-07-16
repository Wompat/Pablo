<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StudentController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('PabloPeopleBundle:Student')->getPagedList(50, $page);

        return $this->render('PabloPeopleBundle:Student:list.html.twig', array(
            'page' => $page,
            'pages' => ceil(count($students)/50),
            'students' => $students,
        ));
    }

    public function searchAction()
    {
        $data = $this->getRequest()->request->all();

        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('PabloPeopleBundle:Student')->getByName($data['lastName'], $data['firstName']);

//        return $this->render('PabloPeopleBundle::debug.html.twig', array(
//            'var' => $data,
//        ));

        return $this->render('PabloPeopleBundle:Student:result.html.twig', array(
            'students' => $students
        ));
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