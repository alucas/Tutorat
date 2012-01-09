<?php

namespace Bdx\TutoratBundle\Form\Type;

use Bdx\TutoratBundle\GCalendar;
use Bdx\TutoratBundle\Form\ChoiceList\TutorAvailableChoiceList;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;

class TutorAvailableType extends AbstractType
{
	private $gcal;
	private $em;

	public function __construct(GCalendar $gcalendar, EntityManager $entityManager)
	{
		$this->gcal = $gcalendar;
		$this->em = $entityManager;
	}

	public function getParent(array $options)
	{
		return 'entity';
	}

	public function getName()
	{
		return 'tutoravailable';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'choice_list' => new TutorAvailableChoiceList($this->em, $this->gcal),
			);
	}
}

