<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', null, array('label' => 'Nom'))
            ->add('firstName', null, array('label' => 'Prénom'))
            ->add('nationality', 'country_selector', array(
                'label' => 'Nationalité',
                'required' => true,
                'attr' => array('class' => 'country-selector')
            ))
            ->add('sex', 'choice', array(
                'label' => 'Sexe',
                'choices' => array('F' => 'Féminin', 'M' => 'Masculin'),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('dateOfBirth', null, array(
                'widget' => 'single_text',
                'label' => 'Date de naissance',
            ))
            ->add('placeOfBirth', null, array('label' => 'Lieu de naissance'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Student'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_studenttype';
    }
}
