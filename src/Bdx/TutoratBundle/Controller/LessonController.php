<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bdx\TutoratBundle\Entity\Lesson;
use Bdx\TutoratBundle\Form\LessonType;

/**
 * Lesson controller.
 *
 */
class LessonController extends Controller
{
    /**
     * Lists all Lesson entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BdxTutoratBundle:Lesson')->findAll();

        return $this->render('BdxTutoratBundle:Lesson:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Lesson entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Lesson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lesson entity.');
        }


        return $this->render('BdxTutoratBundle:Lesson:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Lesson entity.
     *
     */
    public function newAction()
    {
        $entity = new Lesson();
        $form   = $this->createForm(new LessonType(), $entity);

        return $this->render('BdxTutoratBundle:Lesson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Lesson entity.
     *
     */
    public function createAction()
    {
        $entity  = new Lesson();
        $request = $this->getRequest();
        $form    = $this->createForm(new LessonType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lesson_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BdxTutoratBundle:Lesson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Lesson entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Lesson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lesson entity.');
        }

        $editForm = $this->createForm(new LessonType(), $entity);

        return $this->render('BdxTutoratBundle:Lesson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Lesson entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Lesson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lesson entity.');
        }

        $editForm   = $this->createForm(new LessonType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lesson_edit', array('id' => $id)));
        }

        return $this->render('BdxTutoratBundle:Lesson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Displays a confirmation to delete a Lesson entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Lesson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lesson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BdxTutoratBundle:Lesson:delete.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Lesson entity.
     *
     */
    public function destroyAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BdxTutoratBundle:Lesson')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lesson entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lesson'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
