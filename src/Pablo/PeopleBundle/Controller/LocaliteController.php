<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class LocaliteController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloPeopleBundle:Localite')->getCodesEtNoms();

            $cities = array();
            foreach($result as $city) {
                $cities[] = $city[1];
            }

            return new JsonResponse($cities);
        }

        return $this->forward('PabloPeopleBundle:Localite:list');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $localites = $em->getRepository('PabloPeopleBundle:Localite')->findAll();

        return $this->render('PabloPeopleBundle:Localite:list.html.twig', array(
            'localites' => $localites,
        ));
    }
}