<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bdx\TutoratBundle\Entity\Lesson;
use Bdx\TutoratBundle\Form\NewLessonType;


class LessonController extends Controller
{

	public function showAction()
	{
		$lessons = $this->getDoctrine()
			->getRepository('BdxTutoratBundle:Lesson')
			->findAll();

		return $this->render('BdxTutoratBundle:Lesson:show.html.twig', array(
					'lessons' => $lessons,
					));
	}

	public function newAction(Request $request)
	{
		$lesson = new Lesson();
		$form = $this->createForm(new NewLessonType(), $lesson);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
		}

		return $this->render('BdxTutoratBundle:Lesson:new.html.twig', array(
					'form' => $form->createView(),
					));
	}
}

?>
