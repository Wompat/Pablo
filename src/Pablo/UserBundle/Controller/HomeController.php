<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Controller;

use Doctrine\DBAL\Connections;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class HomeController
 * @package Pablo\UserBundle\Controller
 */
class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function welcomeAction()
    {
        $user = $this->getUser();
        return $this->render('PabloUserBundle:Home:welcome.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Affiche la page d'accueil.
     * Affiche un message flash car le module demandé n'est pas encore implémenté.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function notReadyAction()
    {
        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => 'error',
            'content' => 'Ce module n\'a pas encore été développé.'
        ));

        return $this->redirect($this->generateUrl('pablo_user_welcome'));
    }
}