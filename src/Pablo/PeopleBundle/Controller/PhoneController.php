<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Phone;
use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Form\PhoneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhoneController extends Controller
{
    public function addAction($id, Student $student)
    {
        $phone = new Phone();
        $phone->setPerson($student);

        $form = $this->createForm(new PhoneType(), $phone);

        return $this->render('PabloPeopleBundle:Phone:create.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Student $student)
    {
        $phone = new Phone();
        $phone->setPerson($student);

        $form = $this->createForm(new PhoneType(), $phone);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phone);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le numéro a été enregistré.',
            ));

            $url = $this->generateUrl('pablo_student_show', array('id' => $phone->getPerson()->getId())) . '#phones';
            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Phone:create.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Phone $phone)
    {
        $form = $this->createForm(new PhoneType(), $phone);

        return $this->render('PabloPeopleBundle:Phone:edit.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id, Phone $phone)
    {
        $form = $this->createForm(new PhoneType(), $phone);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le numéro a été modifié.',
            ));

            $url = $this->generateUrl('pablo_student_show', array('id' => $phone->getPerson()->getId())) . '#phones';
            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Phone:edit.html.twig', array(
            'phone' => $phone,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Phone $phone)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($phone);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'Le numéro a été supprimé.',
        ));

        $url = $this->generateUrl('pablo_student_show', array('id' => $phone->getPerson()->getId())) . '#phones';
        return $this->redirect($url);
    }
}