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
 * Class PaysController
 * @package Pablo\PeopleBundle\Controller
 */
class PaysController extends Controller
{
    /**
     * Retourne un tableau JSON des noms des pays
     * Redirige vers la page html si la requête n'est pas du type XmlHttpRequest
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Affiche la liste des pays
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pays = $em->getRepository('PabloPeopleBundle:Pays')->findAll();

        return $this->render('PabloPeopleBundle:Pays:list.html.twig', array(
            'pays' => $pays,
        ));
    }
}