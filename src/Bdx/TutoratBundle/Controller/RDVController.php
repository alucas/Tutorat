<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Bdx\TutoratBundle\Entity\RDV;
use Bdx\TutoratBundle\Form\RDVType;
use Bdx\TutoratBundle\Form\Step1RDVType;
use Bdx\TutoratBundle\Form\Step2RDVType;
use Bdx\TutoratBundle\Form\Step3RDVType;
use Bdx\TutoratBundle\Form\Step4RDVType;

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
    public function newAction($step)
    {
        $entity = new RDV();

		switch ($step) {
			case 1:
				$form = $this->createForm(new Step1RDVType(), $entity);
				break;
			case 2:
				$date = new \DateTime();
				$date->setTime(14, 0);
				$entity->setStart($date);
				$entity->setDuration(90);
				$form = $this->createForm(new Step2RDVType(), $entity);
				break;
			case 3:
				$form = $this->createForm(new Step3RDVType(), $entity);
				break;
			case 4:
				$form = $this->createForm(new Step4RDVType(), $entity);
				break;
			default:
				throw Exception('Invalid \'step\' value : '.$step);
		}

        return $this->render('BdxTutoratBundle:RDV:new'.$step.'.html.twig', array(
            'step'   => $step,
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new RDV entity.
     *
     */
    public function createAction($step)
    {
        $entity  = new RDV();
        $request = $this->getRequest();
		$session = $this->getRequest()->getSession();

		switch ($step) {
			case 1:
				$form = $this->createForm(new Step1RDVType(), $entity);
				$form->bindRequest($request);

				if (!$form->isValid()) {
					break;
				}

				$session->set('rdv_new_student', $entity->getStudent());

				return $this->redirect($this->generateUrl('rdv_new', array(
							'step' => $step + 1,
							)));
			case 2:
				$form = $this->createForm(new Step2RDVType(), $entity);
				$form->bindRequest($request);

				if (!$form->isValid()) {
					break;
				}

				$session->set('rdv_new_lesson', $entity->getLesson());
				$session->set('rdv_new_start', $entity->getStart());
				$session->set('rdv_new_duration', $entity->getDuration());

				return $this->redirect($this->generateUrl('rdv_new', array(
							'step' => $step + 1,
							)));
			case 3:
				$form = $this->createForm(new Step3RDVType(), $entity);
				$form->bindRequest($request);

				if (!$form->isValid()) {
					break;
				}

				$session->set('rdv_new_tutor', $entity->getTutor());

				return $this->redirect($this->generateUrl('rdv_new', array(
							'step' => $step + 1,
							)));
			case 4:
				$form = $this->createForm(new Step4RDVType(), $entity);
				$form->bindRequest($request);

				if (!$form->isValid()) {
					break;
				}

				// Retrieve untracked entities
				$old_student = $session->get('rdv_new_student');
				$old_lesson = $session->get('rdv_new_lesson');
				$old_tutor = $session->get('rdv_new_tutor');

				// Fetch new entities
				$em = $this->getDoctrine()->getEntityManager();
				$student = $em->getRepository('BdxTutoratBundle:Student')
						        ->find($old_student->getId());

				if (!$student) {
					throw $this->createNotFoundException(
							'No student found for id '.$old_student->getId());
				}

				$lesson = $em->getRepository('BdxTutoratBundle:Lesson')
						        ->find($old_lesson->getId());

				if (!$lesson) {
					throw $this->createNotFoundException(
							'No lesson found for id '.$old_lesson->getId());
				}

				$tutor = $em->getRepository('BdxTutoratBundle:Tutor')
						        ->find($old_tutor->getId());

				if (!$tutor) {
					throw $this->createNotFoundException(
							'No tutor found for id '.$old_tutor->getId());
				}

				// Fill the new entity
				$entity->setStudent($student);
				$entity->setLesson($lesson);
				$entity->setStart($session->get('rdv_new_start'));
				$entity->setDuration($session->get('rdv_new_duration'));
				$entity->setTutor($tutor);
				$entity->setState('Nouveau');

				// Validate the new entity
				$validator = $this->get('validator');
				$errors = $validator->validate($entity);

				if (count($errors) > 0) {
					throw Exception('Some entity\'s fields are wrong');
				}

				// Persist the new entity
				$em->persist($entity);
				$em->flush();

				//  Add a new event to gcalendar
				$start = $entity->getStart();
				$end = clone $entity->getStart();
				$end->add(new \DateInterval('PT'.$entity->getDuration().'M'));

				$gcalendar = $this->get('gcalendar');
				$client = $gcalendar->hardLogin();
				$gcalendar->createEvent($client, $start, $end,
						$entity->getTutor()->getName().' - '.$entity->getLesson()->getName(),
						$entity->getDescription(), 'Cremi'
						);

				return $this->redirect($this->generateUrl('rdv_show', array(
							'id' => $entity->getId(),
							)));
			default:
				throw Exception('Invalid \'step\' value : '.$step);
		}

        return $this->render('BdxTutoratBundle:RDV:new'.$step.'.html.twig', array(
            'step'   => $step,
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
