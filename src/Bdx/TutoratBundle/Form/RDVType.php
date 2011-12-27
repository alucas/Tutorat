<?php

namespace Bdx\TutoratBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RDVType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('start')
            ->add('duration')
            ->add('tutor')
            ->add('student')
            ->add('lesson')
			->add('state', 'choice', array(
					'choices' => array(
						'Nouveau' => 'Nouveau',
						'Confirmé' => 'Confirmé',
						'Annulé' => 'Annulé',
						'Tuteur absent' => 'Tuteur absent',
						'Etudiant absent' => 'Etudiant absent',
						)
					))
            ->add('information', null, array('required' => false))
        ;
    }

    public function getName()
    {
        return 'bdx_tutoratbundle_rdvtype';
    }
}
