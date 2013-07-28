<?php

namespace Pablo\OrgBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CoursController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloOrgBundle:Cours')->getSpecialties();

            $specialties = array();
            foreach($result as $specialty) {
                $specialties[] = array(
                    'id' => $specialty->getId(),
                    'title' => $specialty->getTitle(),
                    'parent' => $specialty->getParent()->getId(),
                );
            }

            return new JsonResponse($specialties);
        }

        return $this->forward('PabloOrgBundle:Cours:list');
    }

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $courses = $em->getRepository('PabloOrgBundle:Cours')->findAll();

        return $this->render('PabloOrgBundle:Cours:list.html.twig', array(
            'courses' => $courses,
        ));
    }
}