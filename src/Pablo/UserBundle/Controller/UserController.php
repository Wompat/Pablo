<?php

namespace Pablo\UserBundle\Controller;

use Pablo\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\UserBundle\Entity\User;
use Pablo\PeopleBundle\Entity\Teacher;

class UserController extends Controller
{
    public function homeAction()
    {
        return $this->render('PabloUserBundle:User:home.html.twig');
    }

    public function addAction($id, Teacher $teacher)
    {
        $user = new User();
        $user->setTeacher($teacher);

        $form = $this->createForm(new UserType(), $user);

        return $this->render('PabloUserBundle:User:create.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Teacher $teacher)
    {
        $user = new User();
        $user->setTeacher($teacher);

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'utilisateur a été créé avec succès.',
            ));

            $url = $this->generateUrl('pablo_teacher_show', array('id' => $user->getTeacher()->getId()));
            return $this->redirect($url);
        }

        return $this->render('PabloUserBundle:User:create.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}