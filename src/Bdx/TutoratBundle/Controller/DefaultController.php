<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;


class DefaultController extends Controller
{
	public function indexAction($name)
	{
		return $this->render('BdxTutoratBundle:Default:index.html.twig', array('name' => $name));
	}

	public function showLessonsAction()
	{
        $em = $this->getDoctrine()->getEntityManager();
		$tutors = $em->getRepository('BdxTutoratBundle:Tutor')
		                      ->findAll();
		$lessons = $em->getRepository('BdxTutoratBundle:Lesson')
		                      ->findAll();

		$getLessonId = function($lesson)
		{
			return $lesson->getId();
		};

		$tutorsLessons = array();
		foreach ($tutors as $tutor) {
			$tutorsLessons[$tutor->getId()] = $tutor->getLessons()->map($getLessonId);
		}

		return $this->render('BdxTutoratBundle:Default:showLessons.html.twig', array(
				'tutors' => $tutors,
				'lessons' => $lessons,
				'tutorsLessons' => $tutorsLessons,
				));
	}
}

?>
