<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Bdx\TutoratBundle\Entity\Lesson;
use Bdx\TutoratBundle\Form\NewLessonType;


class DefaultController extends Controller
{

	public function indexAction($name)
	{
		return $this->render('BdxTutoratBundle:Default:index.html.twig', array('name' => $name));
	}

	public function lessonAction(Request $request)
	{
		$lesson = new Lesson();
		$form = $this->createForm(new NewLessonType(), $lesson);

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
		}

		return $this->render('BdxTutoratBundle:Default:lesson.html.twig', array(
					'form' => $form->createView(),
					));
	}
}
