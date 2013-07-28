<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array('label' => 'Nom'))
            ->add('prenom', null, array('label' => 'Prénom'))
            ->add('pays', 'country_selector', array(
                'label' => 'Nationalité',
                'required' => true,
                'attr' => array('class' => 'country-selector')
            ))
            ->add('sexe', 'choice', array(
                'label' => 'Sexe',
                'choices' => array('F' => 'Féminin', 'M' => 'Masculin'),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('datenaissance', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'label' => 'Date de naissance',
                'attr' => array('class' => 'date-selector'),
            ))
            ->add('lieunaissance', null, array('label' => 'Lieu de naissance'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Personne'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_personnetype';
    }
}
