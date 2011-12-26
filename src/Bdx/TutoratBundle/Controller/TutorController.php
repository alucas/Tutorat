<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bdx\TutoratBundle\Entity\Tutor;
use Bdx\TutoratBundle\Form\TutorType;

/**
 * Tutor controller.
 *
 */
class TutorController extends Controller
{
    /**
     * Lists all Tutor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BdxTutoratBundle:Tutor')->findAll();

        return $this->render('BdxTutoratBundle:Tutor:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Tutor entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        return $this->render('BdxTutoratBundle:Tutor:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to create a new Tutor entity.
     *
     */
    public function newAction()
    {
        $entity = new Tutor();
        $form   = $this->createForm(new TutorType(), $entity);

        return $this->render('BdxTutoratBundle:Tutor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Tutor entity.
     *
     */
    public function createAction()
    {
        $entity  = new Tutor();
        $request = $this->getRequest();
        $form    = $this->createForm(new TutorType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tutor_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BdxTutoratBundle:Tutor:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Tutor entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        $editForm = $this->createForm(new TutorType(), $entity);

        return $this->render('BdxTutoratBundle:Tutor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Tutor entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        $editForm   = $this->createForm(new TutorType(), $entity);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tutor_edit', array('id' => $id)));
        }

        return $this->render('BdxTutoratBundle:Tutor:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Displays a confirmation to delete a Tutor entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:Tutor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tutor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BdxTutoratBundle:Tutor:delete.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Tutor entity.
     *
     */
    public function destroyAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BdxTutoratBundle:Tutor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tutor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tutor'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
