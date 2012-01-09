<?php

namespace Bdx\TutoratBundle\Form\ChoiceList;

use Bdx\TutoratBundle\GCalendar;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\ChoiceList\EntityChoiceList;

class TutorAvailableChoiceList extends EntityChoiceList
{
	/**
	 * @var string
	 */
	private static $className = 'BdxTutoratBundle:Tutor';

	/**
	 * @var Bdx\TutoratBundle\GCalendar
	 */
	private $gcal;

	/**
	 * Constructor.
	 *
	 * @param EntityManager         $em     An EntityManager instance
	 * @param GCalendar             $gcal   An GCalendar instance
	 */
	public function __construct(EntityManager $em, GCalendar $gcal)
	{
		parent::__construct($em, self::$className);

		$this->gcal = $gcal;
	}

	/**
	 * Initializes the choices.
	 *
	 * @return array  An array of choices
	 */
	protected function load()
	{
		$choices = parent::load();

		// gcal filters

		return $choices;
	}
}

