<?php

namespace Pablo\OrganisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;

class AttributionController extends Controller
{
    public function indexAction()
    {
        return new Response('Ok', 200);
    }
}