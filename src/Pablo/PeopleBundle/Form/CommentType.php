<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', null, array(
                'label' => 'Tapez ici le contenu de votre remarque.',
                'attr' => array(
                    'class' => 'span6',
                    'rows' => 6,
                    'style' => 'resize: none;'
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\PeopleBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_commenttype';
    }
}
