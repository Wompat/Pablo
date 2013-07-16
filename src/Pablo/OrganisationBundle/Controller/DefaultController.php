<?php

namespace Pablo\OrganisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PabloOrganisationBundle:Default:home.html.twig', array('name' => $name));
    }
}
