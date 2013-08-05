<?php

namespace Pablo\UserBundle\Controller;

use Doctrine\DBAL\Connections;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function welcomeAction()
    {
        $user = $this->getUser();
        return $this->render('PabloUserBundle:Home:welcome.html.twig', array(
            'user' => $user,
        ));
    }

    public function notReadyAction()
    {
        $this->get('session')->getFlashBag()->add('notice', array(
            'type' => 'error',
            'content' => 'Ce module n\'a pas encore été développé.'
        ));

        return $this->redirect($this->generateUrl('pablo_user_welcome'));
    }
}