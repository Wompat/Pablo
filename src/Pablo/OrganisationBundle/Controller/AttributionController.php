<?php

namespace Pablo\OrganisationBundle\Controller;

use Pablo\OrganisationBundle\Entity\Attribution;
use Pablo\OrganisationBundle\Form\AttributionType;
use Pablo\PeopleBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AttributionController extends Controller
{
    public function listAction()
    {
        return $this->render('PabloOrganisationBundle:Attribution:list.html.twig');
    }

    public function addAction($id, Teacher $teacher)
    {
        $attribution = new Attribution();
        $attribution->setTeacher($teacher);

        $form = $this->createForm(new AttributionType(), $attribution);

        return $this->render('PabloOrganisationBundle:Attribution:create.html.twig', array(
            'attribution' => $attribution,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Teacher $teacher)
    {
        $attribution = new Attribution();
        $attribution->setTeacher($teacher);

        $form = $this->createForm(new AttributionType(), $attribution);
        $form->handleRequest($this->getRequest());

        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($attribution);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'L\'attribution a été enregistrée.'
            ));

            $url = $this->generateUrl('pablo_teacher_show', array('id' => $attribution->getTeacher()->getId())) . '#attributions';
            return $this->redirect($url);
        }

        return $this->render('PabloOrganisationBundle:Attribution:create.html.twig', array(
            'attribution' => $attribution,
            'form' => $form->createView(),
        ));
    }
}