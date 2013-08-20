<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\UserBundle\Form\ProfileType;

/**
 * Class ProfileController
 * @package Pablo\UserBundle\Controller
 */
class ProfileController extends Controller
{
    /**
     * Affiche le formulaire d'édition du profil de l'utilisateur
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction()
    {
        $user = $this->getUser();

        $form = $this->createForm(new ProfileType(), $user);

        return $this->render('PabloUserBundle:Profile:edit.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Valide le formulaire et enregistre le profil modifié
     * Redirige vers la page d'accueil
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction()
    {
        $user = $this->getUser();

        $form = $this->createForm(new ProfileType, $user);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
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