<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
			->add('email', null, array('required' => false))
			->add('tel', null, array('required' => false))
			->add('information', null, array('required' => false));
        ;
    }

    public function getName()
    {
        return 'bdx_tutoratbundle_studenttype';
    }

	public function getDefaultOptions(array $options)
	{
	    return array(
		        'data_class' => 'Bdx\TutoratBundle\Entity\Student',
				);
	}
}
