<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloPeopleBundle:City')->getCodesAndNames();

            $cities = array();
            foreach($result as $city) {
                $cities[] = $city[1];
            }

            return new JsonResponse($cities);
        }

        return $this->forward('PabloPeopleBundle:City:list');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cities = $em->getRepository('PabloPeopleBundle:City')->findAll();

        return $this->render('PabloPeopleBundle:City:list.html.twig', array(
            'cities' => $cities,
        ));
    }
}