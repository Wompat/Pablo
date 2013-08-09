<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TelephoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, array('label' => 'Numéro'))
            ->add('mobile', null, array(
                'label' => 'SMS',
                'required' => false,
                'attr' => array('value' => false),
            ))
            ->add('info')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Telephone'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_telephonetype';
    }
}
