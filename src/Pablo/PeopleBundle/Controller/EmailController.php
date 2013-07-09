<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Email;
use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Entity\Teacher;
use Pablo\PeopleBundle\Form\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmailController extends Controller
{
    public function addAction($id, Student $student)
    {
        $email = new Email();
        $email->setPerson($student);

        $form = $this->createForm(new EmailType(), $email);

        return $this->render('PabloPeopleBundle:Email:create.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Student $student)
    {
        $email = new Email();
        $email->setPerson($student);

        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse e-mail a été enregistrée.',
            ));

            if ($email->getPerson() instanceof Teacher) {
                $url = $this->generateUrl('pablo_teacher_show', array('id' => $email->getPerson()->getId())) . '#emails';
            } else {
                $url = $this->generateUrl('pablo_student_show', array('id' => $email->getPerson()->getId())) . '#emails';
            }

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Email:create.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Email $email)
    {
        $form = $this->createForm(new EmailType(), $email);

        return $this->render('PabloPeopleBundle:Email:edit.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id, Email $email)
    {
        $form = $this->createForm(new EmailType(), $email);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse e-mail a été modifiée.',
            ));

            if ($email->getPerson() instanceof Teacher) {
                $url = $this->generateUrl('pablo_teacher_show', array('id' => $email->getPerson()->getId())) . '#emails';
            } else {
                $url = $this->generateUrl('pablo_student_show', array('id' => $email->getPerson()->getId())) . '#emails';
            }

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Email:edit.html.twig', array(
            'email' => $email,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Email $email)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($email);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'L\'adresse e-mail a été supprimée.',
        ));

        if ($email->getPerson() instanceof Teacher) {
            $url = $this->generateUrl('pablo_teacher_show', array('id' => $email->getPerson()->getId())) . '#emails';
        } else {
            $url = $this->generateUrl('pablo_student_show', array('id' => $email->getPerson()->getId())) . '#emails';
        }

        return $this->redirect($url);
    }
}