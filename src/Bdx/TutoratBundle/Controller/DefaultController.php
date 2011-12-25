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
}

?>
