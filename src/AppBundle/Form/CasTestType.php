<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CasTestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('numero', null, array(
                    'label' => 'Cas de test',
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                ))
                ->add('titre', null, array(
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                ))
                ->add('objectif', null, array(
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                ))
                ->add('prerequis', CollectionType::class, array(
                    'label' => 'Prérequis',
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                    'entry_type' => PrerequisType::class,
                    'entry_options' => array(
                        'label' => false,
                    ),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                ))
                ->add('initialisation', null, array(
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => false,
                ))
                ->add('batteries', CollectionType::class, array(
                    'label' => 'Batteries',
                    'attr' => array(
                        'class' => 'form-control form-control-sm',
                        'readonly' => $options['readonly'],
                    ),
                    'required' => true,
                    'entry_type' => BatterieType::class,
                    'entry_options' => array(
                        'label' => false,
                    ),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CasTest',
            'readonly' => FALSE,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_castest';
    }


}
