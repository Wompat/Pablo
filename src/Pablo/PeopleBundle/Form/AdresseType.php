<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voie', null, array('label' => 'Rue'))
            ->add('numero', null, array('label' => 'Numéro'))
            ->add('boite', null, array('label' => 'Boîte'))
            ->add('localite', null, array(
                'label' => 'CP et localité',
                'attr' => array('class' => 'city-selector')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Adresse'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_adressetype';
    }
}
