<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class LocaliteController
 * @package Pablo\PeopleBundle\Controller
 */
class LocaliteController extends Controller
{
    /**
     * Retourne un tableau d'objets au format JSON des codes postaux et des noms des localités
     * Redirige vers la page html si la requête n'est pas du type XmlHttpRequest
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Affiche la liste des localités
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $localites = $em->getRepository('PabloPeopleBundle:Localite')->findAll();

        return $this->render('PabloPeopleBundle:Localite:list.html.twig', array(
            'localites' => $localites,
        ));
    }
}