<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('information')
			->add('information', null, array('required' => false));
        ;
    }

    public function getName()
    {
        return 'bdx_tutoratbundle_lessontype';
    }

	public function getDefaultOptions(array $options)
	{
	    return array(
		        'data_class' => 'Bdx\TutoratBundle\Entity\Lesson',
				);
	}
}
