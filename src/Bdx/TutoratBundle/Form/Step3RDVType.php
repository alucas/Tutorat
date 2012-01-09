<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class Step3RDVType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder
			->add('tutor', 'tutoravailable')
			;
	}

	public function getName()
	{
		return 'bdx_tutoratbundle_step3rdvtype';
	}

	public function getDefaultOptions(array $options)
	{
		return array(
				'validation_groups' => array('step3')
				);
	}
}
