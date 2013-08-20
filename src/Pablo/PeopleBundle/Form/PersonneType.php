<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\PeopleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PersonneType
 * @package Pablo\PeopleBundle\Form
 */
class PersonneType extends AbstractType
{
    /**
     * Builds the form.
     *
     * This method is called for each type in the hierarchy starting form the
     * top most type. Type extensions can further modify the form.
     *
     * @see FormTypeExtensionInterface::buildForm()
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
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

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
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
        return 'pablo_peoplebundle_personnetype';
    }
}
