<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bdx\TutoratBundle\Entity\RDV;
use Bdx\TutoratBundle\Form\RDVType;

/**
 * RDV controller.
 *
 */
class RDVController extends Controller
{
    /**
     * Lists all RDV entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BdxTutoratBundle:RDV')->findAll();

        return $this->render('BdxTutoratBundle:RDV:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a RDV entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:RDV')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RDV entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BdxTutoratBundle:RDV:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new RDV entity.
     *
     */
    public function newAction()
    {
        $entity = new RDV();
        $form   = $this->createForm(new RDVType(), $entity);

        return $this->render('BdxTutoratBundle:RDV:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new RDV entity.
     *
     */
    public function createAction()
    {
        $entity  = new RDV();
        $request = $this->getRequest();
        $form    = $this->createForm(new RDVType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BdxTutoratBundle:RDV:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing RDV entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:RDV')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RDV entity.');
        }

        $editForm = $this->createForm(new RDVType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BdxTutoratBundle:RDV:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing RDV entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:RDV')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RDV entity.');
        }

        $editForm   = $this->createForm(new RDVType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rdv_edit', array('id' => $id)));
        }

        return $this->render('BdxTutoratBundle:RDV:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a confirmation to delete a RDV entity.
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BdxTutoratBundle:RDV')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find RDV entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BdxTutoratBundle:RDV:delete.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a RDV entity.
     *
     */
    public function destroyAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BdxTutoratBundle:RDV')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find RDV entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rdv'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
