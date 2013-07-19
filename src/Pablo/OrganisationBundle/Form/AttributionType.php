<?php

namespace Pablo\OrganisationBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AttributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year', null, array(
                'label' => 'Année scolaire',
            ))
            ->add('periods', null, array(
                'label' => 'Nb périodes',
            ))
            ->add('startDate', null, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'label' => 'Date de début',
                'attr' => array('class' => 'date-selector-from'),
            ))
            ->add('endDate', null, array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'label' => 'Date de fin',
                'attr' => array('class' => 'date-selector-to'),
            ))
            ->add('jobFunction', null, array(
                'label' => 'Fonction',
                'attr' => array('class' => 'input-mini')
            ))
            ->add('status', null, array(
                'label' => 'Statut',
                'attr' => array('class' => 'input-mini')
            ))
            ->add('course', 'entity', array(
                'class' => 'PabloOrganisationBundle:Course',
                'property' => 'title',
                'query_builder' => function(EntityRepository $er) {
                    $qb = $er->createQueryBuilder('c');
                    return $qb
                        ->where($qb->expr()->isNull('c.parent'))
                        ->andWhere('c.domain = 4')
                        ->orderBy('c.domain', 'DESC')
                        ->addOrderBy('c.title');
                },
//                'group_by' => 'domain.shortName',
                'label' => 'Intitulé',
                'required' => false,
                'attr' => array('class' => 'input-xlarge')
            ))
            ->add('specialty', 'entity', array(
                'class' => 'PabloOrganisationBundle:Course',
                'property' => 'title',
                'query_builder' => function(EntityRepository  $er) {
                    $qb = $er->createQueryBuilder('s');
                    return $qb
                        ->where($qb->expr()->isNotNull('s.parent'))
                        ->andWhere('s.domain = 4')
                        ->orderBy('s.domain')
                        ->addOrderBy('s.parent')
                        ->addOrderBy('s.title')
                    ;
                },
                'group_by' => 'parent.title',
                'label' => 'Spécialité',
                'required' => false,
                'attr' => array('class' => 'input-xlarge')
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pablo\OrganisationBundle\Entity\Attribution'
        ));
    }

    public function getName()
    {
        return 'pablo_organisationbundle_attributiontype';
    }
}
