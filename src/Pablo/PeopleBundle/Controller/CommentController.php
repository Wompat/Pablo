<?php

namespace Pablo\PeopleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pablo\PeopleBundle\Entity\Student;
use Pablo\PeopleBundle\Entity\Teacher;
use Pablo\PeopleBundle\Entity\Comment;
use Pablo\PeopleBundle\Form\CommentType;

class CommentController extends Controller
{
    public function addAction($id, Student $student)
    {
        $comment = new Comment();
        $comment->setPerson($student);
        $comment->setUser($this->getUser());

        $form = $this->createForm(new CommentType(), $comment);

        return $this->render('PabloPeopleBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    public function createAction($id, Student $student)
    {
        $comment = new Comment();
        $comment->setPerson($student);
        $comment->setUser($this->getUser());

        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->get('session')->getFlashBag()->add('notice', array(
                'type' => 'success',
                'content' => 'Le commentaire a été enregistré.',
            ));

            if ($comment->getPerson() instanceof Teacher) {
                $url = $this->generateUrl('pablo_teacher_show', array('id' => $comment->getPerson()->getId())) . '#comments';
            } else {
                $url = $this->generateUrl('pablo_student_show', array('id' => $comment->getPerson()->getId())) . '#comments';
            }

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Comment $comment)
    {
        $form = $this->createForm(new CommentType(), $comment);

        return $this->render('PabloPeopleBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    public function updateAction($id, Comment $comment)
    {
        $form = $this->createForm(new CommentType(), $comment);
        $form->handleRequest($this->getRequest());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->get('session')->getFlashBag()->Add('notice', array(
                'type' => 'success',
                'content' => 'Le commentaire a été modifié.',
            ));

            if ($comment->getPerson() instanceof Teacher) {
                $url = $this->generateUrl('pablo_teacher_show', array('id' => $comment->getPerson()->getId())) . '#comments';
            } else {
                $url = $this->generateUrl('pablo_student_show', array('id' => $comment->getPerson()->getId())) . '#comments';
            }

            return $this->redirect($url);
        }

        return $this->render('PabloPeopleBundle:Comment:edit.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        $this->get('session')->getFlashBag()->Add('notice', array(
            'type' => null,
            'content' => 'Le commentaire a été supprimé.'
        ));

        if ($comment->getPerson() instanceof Teacher) {
            $url = $this->generateUrl('pablo_teacher_show', array('id' => $comment->getPerson()->getId())) . '#comments';
        } else {
            $url = $this->generateUrl('pablo_student_show', array('id' => $comment->getPerson()->getId())) . '#comments';
        }

        return $this->redirect($url);
    }
}