<?php

namespace Bdx\TutoratBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bdx\TutoratBundle\Entity\User;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BdxTutoratBundle:User')->findAll();

        return $this->render('BdxTutoratBundle:User:index.html.twig', array(
            'entities' => $entities
        ));
    }
}
