<?php

namespace Pablo\OrganisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloOrganisationBundle:Course')->getSpecialties();

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

        return $this->forward('PabloOrganisationBundle:Course:list');
    }

    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $courses = $em->getRepository('PabloOrganisationBundle:Course')->findAll();

        return $this->render('PabloOrganisationBundle:Course:list.html.twig', array(
            'courses' => $courses,
        ));
    }
}