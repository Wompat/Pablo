<?php

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu', null, array(
                'label' => 'Tapez ici votre commentaire.',
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
            'data_class' => 'Pablo\PeopleBundle\Entity\Commentaire'
        ));
    }

    public function getName()
    {
        return 'pablo_peoplebundle_commentairetype';
    }
}
