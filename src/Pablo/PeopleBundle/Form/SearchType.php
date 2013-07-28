<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, array(
                'required' => false,
                'attr' => array('class' => 'span3', 'placeholder' => 'Nom')
            ))
            ->add('prenom', null, array(
                'required' => false,
                'attr' => array('class' => 'span3', 'placeholder' => 'Prénom')
            ))
            ->add('datenaissance', null, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'attr' => array('class' => 'span3 date-selector', 'placeholder' => 'Date de naissance'),
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Personne'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'pablo_peoplebundle_searchtype';
    }
}