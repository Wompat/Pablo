<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeacherType extends StudentType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('matricule');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Teacher'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_teachertype';
    }
}
