<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaysController extends Controller
{
    public function jsonAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $result = $em->getRepository('PabloPeopleBundle:Pays')->getNoms();

            $pays = array();
            foreach($result as $item) {
                $pays[] = $item['nom'];
            }

            return new JsonResponse($pays);
        }

        return $this->forward('PabloPeopleBundle:Pays:list');
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('PabloPeopleBundle:Pays')->findAll();

        return $this->render('PabloPeopleBundle:Pays:list.html.twig', array(
            'pays' => $pays,
        ));
    }
}