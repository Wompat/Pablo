<?php

namespace Pablo\PeopleBundle\Controller;

use Pablo\PeopleBundle\Entity\Address;
use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddressController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $addresses = $em->getRepository('PabloPeopleBundle:Address')->findAll();

        return $this->render('PabloPeopleBundle:Address:list.html.twig', array(
            'addresses' => $addresses,
        ));
    }

    public function addAction($id, Student $student)
    {
        $address = new Address();
        $address->setPerson($student);

        $form = $this->createForm(new AddressType(), $address);

        return $this->render('PabloPeopleBundle:Address:create.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Student $student)
    {
        $address = new Address();
        $address->setPerson($student);

        $form = $this->createForm(new AddressType(), $address);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse a été enregistrée.'
            ));

            // TODO: adapter la redirection selon qu'il s'agit de l'adresse d'un élève ou d'un prof !
            $url = $this->generateUrl('pablo_student_show', array('id' => $address->getPerson()->getId())) . '#addresses';
            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Address:create.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * Affiche le formulaire d'édition d'une adresse
     *
     * @param $id
     * @param Address $address
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Address $address)
    {
        $form = $this->createForm(new AddressType(), $address);

        return $this->render('PabloPeopleBundle:Address:edit.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et met l'adresse à jour
     *
     * @param $id
     * @param \Pablo\PeopleBundle\Entity\Address $address
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($id, Address $address)
    {
        $form = $this->createForm(new AddressType(), $address);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'adresse a été modifiée.'
            ));

            $url = $this->generateUrl('pablo_student_show', array('id' => $address->getPerson()->getId())) . '#addresses';
            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Address:edit.html.twig', array(
            'address' => $address,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Address $address)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($address);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => null,
            'content' => 'L\'adresse a été supprimée.'
        ));

        $url = $this->generateUrl('pablo_student_show', array('id' => $address->getPerson()->getId())) . '#addresses';
        return $this->redirect($url);
    }
}