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
}