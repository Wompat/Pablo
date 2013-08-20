<?php

/**
 * Ce fichier est une partie de l'application Pablo.
 *
 * @author Thomas Decraux <thomasdecraux@gmail.com>
 * @version <0.1.0>
 */

namespace Pablo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class UserType
 * @package Pablo\UserBundle\Form
 */
class UserType extends AbstractType
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
            ->add('username', null, array('label' => 'Nom d\'utilisateur'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'first_options' => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
            ))
            ->add('enabled', null, array('label' => 'Activé'))
            ->add('groups', null, array(
                'label' => 'Groupe',
                'multiple' => false,
            ))
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
            'data_class' => 'Pablo\UserBundle\Entity\User'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'pablo_userbundle_usertype';
    }
}
