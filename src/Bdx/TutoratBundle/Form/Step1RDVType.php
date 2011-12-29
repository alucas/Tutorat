<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Step1RDVType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('student')
			;
	}

	public function getName()
	{
		return 'bdx_tutoratbundle_step1rdvtype';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'validation_groups' => array('step1')
				);
	}
}
