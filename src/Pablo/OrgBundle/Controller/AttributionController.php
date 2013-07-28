<?php

namespace Pablo\OrgBundle\Controller;

use Pablo\OrgBundle\Entity\Attribution;
use Pablo\OrgBundle\Form\AttributionType;
use Pablo\PeopleBundle\Entity\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AttributionController extends Controller
{
    public function listAction()
    {
        return $this->render('PabloOrgBundle:Attribution:list.html.twig');
    }

    public function addAction($id, Employe $teacher)
    {
        $attribution = new Attribution();
        $attribution->setTeacher($teacher);

        $form = $this->createForm(new AttributionType(), $attribution);

        return $this->render('PabloOrgBundle:Attribution:create.html.twig', array(
            'attribution' => $attribution,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Employe $teacher)
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

        return $this->render('PabloOrgBundle:Attribution:create.html.twig', array(
            'attribution' => $attribution,
            'form' => $form->createView(),
        ));
    }
}