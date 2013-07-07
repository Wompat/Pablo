<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('street', null, array('label' => 'Rue'))
            ->add('number', null, array('label' => 'Numéro'))
            ->add('flat', null, array('label' => 'Boîte'))
            ->add('city', null, array(
                'label' => 'CP et localité',
                'attr' => array('class' => 'city-selector')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_addresstype';
    }
}
