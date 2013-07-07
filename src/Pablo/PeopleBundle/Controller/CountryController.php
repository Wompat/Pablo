<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloPeopleBundle:Country')->getNames();

            $countries = array();
            foreach($result as $country) {
                $countries[] = $country['name'];
            }

            return new JsonResponse($countries);
        }

        return $this->forward('PabloPeopleBundle:Country:list');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $countries = $em->getRepository('PabloPeopleBundle:Country')->findAll();

        return $this->render('PabloPeopleBundle:Country:list.html.twig', array(
            'countries' => $countries,
        ));
    }
}