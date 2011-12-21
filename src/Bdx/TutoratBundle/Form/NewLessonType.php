<?php

// src/Bdx/TutoratBundle/Form/newLessonType.php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NewLessonType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('name');
		$builder->add('information', null, array('required' => false));
	}

	public function getName()
	{
		return 'newLesson';
	}

	public function getDefaultOptions(array $options)
	{
	    return array(
		        'data_class' => 'Bdx\TutoratBundle\Entity\Lesson',
				);
	}
}

?>
