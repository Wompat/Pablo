<?php

namespace Pablo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\UserBundle\Form\ProfileType;

class ProfileController extends Controller
{
    public function editAction()
    {
        $user = $this->getUser();

        $form = $this->createForm(new ProfileType(), $user);

        return $this->render('PabloUserBundle:Profile:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function updateAction()
    {
        $user = $this->getUser();

        $form = $this->createForm(new ProfileType, $user);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('profile', array(
                'type' => 'success',
                'content' => 'Le profil a été modifié.'
            ));

            return $this->redirect($this->generateUrl('pablo_user_welcome'));
        }

        return $this->render('PabloUserBundle:Profile:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }
}