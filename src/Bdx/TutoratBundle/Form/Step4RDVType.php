<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Step4RDVType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('information', null, array('required' => false))
			;
	}

	public function getName()
	{
		return 'bdx_tutoratbundle_step4rdvtype';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'validation_groups' => array('step4')
				);
	}
}
