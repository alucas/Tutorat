<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Step2RDVType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('start')
			->add('duration')
			->add('lesson')
			;
	}

	public function getName()
	{
		return 'bdx_tutoratbundle_step2rdvtype';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'validation_groups' => array('step2')
				);
	}
}
