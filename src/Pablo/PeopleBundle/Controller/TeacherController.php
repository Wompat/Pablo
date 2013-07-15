<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Teacher;
use Pablo\PeopleBundle\Form\TeacherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeacherController extends Controller
{
    public function listAction($page)
    {
        $em = $this->getDoctrine()->getManager();
        $teachers = $em->getRepository('PabloPeopleBundle:Teacher')->getPagedList(50, $page);

        return $this->render('PabloPeopleBundle:Teacher:list.html.twig', array(
            'page' => $page,
            'pages' => ceil(count($teachers)/50),
            'teachers' => $teachers,
        ));
    }

    public function searchAction()
    {
        $data = $this->getRequest()->request->all();

        $em = $this->getDoctrine()->getManager();
        $teachers = $em->getRepository('PabloPeopleBundle:Teacher')->getByName($data['lastName'], $data['firstName']);

        return $this->render('PabloPeopleBundle:Teacher:search.html.twig', array(
            'teachers' => $teachers
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