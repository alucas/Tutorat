<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bdx\TutoratBundle\Entity\Lesson;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{

	public function indexAction($name)
	{
		return $this->render('BdxTutoratBundle:Default:index.html.twig', array('name' => $name));
	}

	public function lessonAction(Request $request)
	{
		$lesson = new Lesson();
		$form = $this->createFormBuilder($lesson)
			->add('name', 'text')
			->add('information', 'textarea')
			->getForm();

		if ($request->getMethod() == 'POST') {
			$form->bindRequest($request);
		}

		return $this->render('BdxTutoratBundle:Default:lesson.html.twig', array(
					'form' => $form->createView(),
					));
	}
}
